<?php
$adminPageTitle = 'Gallery Management';
$adminPage = 'gallery';

require_once __DIR__ . '/../includes/bootstrap.php';
requireAdmin();

if (($_GET['action'] ?? '') === 'delete' && !empty($_GET['id'])) {
    deleteItem('gallery', (string) $_GET['id']);
    setFlash('success', 'Gallery item deleted.');
    redirectTo('/admin/gallery.php');
}

$editing = !empty($_GET['edit']) ? findById('gallery', (string) $_GET['edit']) : null;

if (isPost()) {
    $payload = [
        'id' => trim($_POST['id'] ?? ''),
        'title' => trim($_POST['title'] ?? ''),
        'media_type' => trim($_POST['media_type'] ?? 'image'),
        'media_url' => trim($_POST['media_url'] ?? ''),
    ];

    upsertItem('gallery', $payload);
    setFlash('success', $payload['id'] ? 'Gallery item updated.' : 'Gallery item added.');
    redirectTo('/admin/gallery.php');
}

$gallery = collection('gallery');
require __DIR__ . '/partials/top.php';
?>
<section class="admin-grid-two">
    <article class="table-card">
        <div class="table-card-head">
            <h2><?php echo $editing ? 'Edit Gallery Item' : 'Add Gallery Item'; ?></h2>
        </div>
        <form method="post" class="admin-form-grid">
            <input type="hidden" name="id" value="<?php echo e($editing['id'] ?? ''); ?>">
            <label>
                <span>Title</span>
                <input type="text" name="title" value="<?php echo e($editing['title'] ?? ''); ?>" required>
            </label>
            <label>
                <span>Media Type</span>
                <select name="media_type" required>
                    <?php foreach (['image' => 'Image', 'video' => 'Video'] as $type => $label): ?>
                        <option value="<?php echo e($type); ?>" <?php echo ($editing['media_type'] ?? '') === $type ? 'selected' : ''; ?>><?php echo e($label); ?></option>
                    <?php endforeach; ?>
                </select>
            </label>
            <label class="full-span">
                <span>Media URL</span>
                <input type="url" name="media_url" value="<?php echo e($editing['media_url'] ?? ''); ?>" required>
            </label>
            <button type="submit" class="button button-primary"><?php echo $editing ? 'Update Item' : 'Add Item'; ?></button>
        </form>
    </article>
    <article class="table-card">
        <div class="table-card-head">
            <h2>Gallery Library</h2>
        </div>
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Type</th>
                    <th>Preview</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($gallery as $item): ?>
                    <tr>
                        <td><?php echo e($item['title']); ?></td>
                        <td><?php echo e(ucfirst($item['media_type'])); ?></td>
                        <td><a href="<?php echo e($item['media_url']); ?>" target="_blank" rel="noreferrer">Open</a></td>
                        <td class="action-links">
                            <a href="<?php echo e(appUrl('admin/gallery.php')); ?>?edit=<?php echo e($item['id']); ?>">Edit</a>
                            <a href="<?php echo e(appUrl('admin/gallery.php')); ?>?action=delete&amp;id=<?php echo e($item['id']); ?>" onclick="return confirm('Delete this gallery item?');">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </article>
</section>
<?php require __DIR__ . '/partials/bottom.php'; ?>
