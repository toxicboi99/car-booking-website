<?php
$adminPageTitle = 'Reviews Management';
$adminPage = 'reviews';

require_once __DIR__ . '/../includes/bootstrap.php';
requireAdmin();

if (($_GET['action'] ?? '') === 'delete' && !empty($_GET['id'])) {
    deleteItem('reviews', (string) $_GET['id']);
    setFlash('success', 'Review deleted.');
    redirectTo('/admin/reviews.php');
}

$editing = !empty($_GET['edit']) ? findById('reviews', (string) $_GET['edit']) : null;

if (isPost()) {
    $payload = [
        'id' => trim($_POST['id'] ?? ''),
        'category' => trim($_POST['category'] ?? 'google'),
        'type' => trim($_POST['type'] ?? 'text'),
        'title' => trim($_POST['title'] ?? ''),
        'name' => trim($_POST['name'] ?? ''),
        'route' => trim($_POST['route'] ?? ''),
        'traveler_from' => trim($_POST['traveler_from'] ?? ''),
        'date' => trim($_POST['date'] ?? date('Y-m-d')),
        'rating' => (int) ($_POST['rating'] ?? 5),
        'content' => trim($_POST['content'] ?? ''),
        'media_url' => trim($_POST['media_url'] ?? ''),
    ];

    upsertItem('reviews', $payload);
    setFlash('success', $payload['id'] ? 'Review updated.' : 'Review added.');
    redirectTo('/admin/reviews.php');
}

$reviews = collection('reviews');
require __DIR__ . '/partials/top.php';
?>
<section class="admin-grid-two">
    <article class="table-card">
        <div class="table-card-head">
            <h2><?php echo $editing ? 'Edit Review' : 'Add Review'; ?></h2>
        </div>
        <form method="post" class="admin-form-grid">
            <input type="hidden" name="id" value="<?php echo e($editing['id'] ?? ''); ?>">
            <label>
                <span>Category</span>
                <select name="category" required>
                    <?php foreach (reviewCategories() as $key => $label): ?>
                        <option value="<?php echo e($key); ?>" <?php echo ($editing['category'] ?? '') === $key ? 'selected' : ''; ?>><?php echo e($label); ?></option>
                    <?php endforeach; ?>
                </select>
            </label>
            <label>
                <span>Type</span>
                <select name="type" required>
                    <?php foreach (['text' => 'Text', 'video' => 'Video'] as $type => $label): ?>
                        <option value="<?php echo e($type); ?>" <?php echo ($editing['type'] ?? '') === $type ? 'selected' : ''; ?>><?php echo e($label); ?></option>
                    <?php endforeach; ?>
                </select>
            </label>
            <label>
                <span>Title</span>
                <input type="text" name="title" value="<?php echo e($editing['title'] ?? ''); ?>" required>
            </label>
            <label>
                <span>Customer Name</span>
                <input type="text" name="name" value="<?php echo e($editing['name'] ?? ''); ?>" required>
            </label>
            <label>
                <span>Route</span>
                <input type="text" name="route" value="<?php echo e($editing['route'] ?? ''); ?>" required>
            </label>
            <label>
                <span>Traveler From</span>
                <input type="text" name="traveler_from" value="<?php echo e($editing['traveler_from'] ?? ''); ?>" required>
            </label>
            <label>
                <span>Date</span>
                <input type="date" name="date" value="<?php echo e($editing['date'] ?? ''); ?>" required>
            </label>
            <label>
                <span>Rating</span>
                <input type="number" name="rating" min="1" max="5" value="<?php echo e((string) ($editing['rating'] ?? 5)); ?>" required>
            </label>
            <label class="full-span">
                <span>Review Content</span>
                <textarea name="content" rows="5" required><?php echo e($editing['content'] ?? ''); ?></textarea>
            </label>
            <label class="full-span">
                <span>Cloudinary / Media URL</span>
                <input type="url" name="media_url" value="<?php echo e($editing['media_url'] ?? ''); ?>">
            </label>
            <button type="submit" class="button button-primary"><?php echo $editing ? 'Update Review' : 'Add Review'; ?></button>
        </form>
    </article>
    <article class="table-card">
        <div class="table-card-head">
            <h2>Review Library</h2>
        </div>
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Type</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reviews as $review): ?>
                    <tr>
                        <td><?php echo e($review['title']); ?></td>
                        <td><?php echo e(reviewCategoryLabel($review['category'])); ?></td>
                        <td><?php echo e(ucfirst($review['type'])); ?></td>
                        <td class="action-links">
                            <a href="<?php echo e(appUrl('admin/reviews.php')); ?>?edit=<?php echo e($review['id']); ?>">Edit</a>
                            <a href="<?php echo e(appUrl('admin/reviews.php')); ?>?action=delete&amp;id=<?php echo e($review['id']); ?>" onclick="return confirm('Delete this review?');">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </article>
</section>
<?php require __DIR__ . '/partials/bottom.php'; ?>
