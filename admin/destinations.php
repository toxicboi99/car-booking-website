<?php
$adminPageTitle = 'Destination Management';
$adminPage = 'destinations';

require_once __DIR__ . '/../includes/bootstrap.php';
requireAdmin();

if (($_GET['action'] ?? '') === 'delete' && !empty($_GET['id'])) {
    deleteItem('destinations', (string) $_GET['id']);
    setFlash('success', 'Destination deleted.');
    redirectTo('/admin/destinations.php');
}

$editing = !empty($_GET['edit']) ? findById('destinations', (string) $_GET['edit']) : null;

if (isPost()) {
    $payload = [
        'id' => trim($_POST['id'] ?? ''),
        'route' => trim($_POST['route'] ?? ''),
        'tag' => trim($_POST['tag'] ?? ''),
        'summary' => trim($_POST['summary'] ?? ''),
        'image' => trim($_POST['image'] ?? ''),
    ];

    upsertItem('destinations', $payload);
    setFlash('success', $payload['id'] ? 'Destination updated.' : 'Destination added.');
    redirectTo('/admin/destinations.php');
}

$destinations = collection('destinations');
require __DIR__ . '/partials/top.php';
?>
<section class="admin-grid-two">
    <article class="table-card">
        <div class="table-card-head">
            <h2><?php echo $editing ? 'Edit Destination' : 'Add Destination'; ?></h2>
        </div>
        <form method="post" class="admin-form-grid">
            <input type="hidden" name="id" value="<?php echo e($editing['id'] ?? ''); ?>">
            <label>
                <span>Route</span>
                <input type="text" name="route" value="<?php echo e($editing['route'] ?? ''); ?>" required>
            </label>
            <label>
                <span>Tag</span>
                <input type="text" name="tag" value="<?php echo e($editing['tag'] ?? ''); ?>" required>
            </label>
            <label class="full-span">
                <span>Summary</span>
                <textarea name="summary" rows="4" required><?php echo e($editing['summary'] ?? ''); ?></textarea>
            </label>
            <label class="full-span">
                <span>Image URL</span>
                <input type="url" name="image" value="<?php echo e($editing['image'] ?? ''); ?>" required>
            </label>
            <button type="submit" class="button button-primary"><?php echo $editing ? 'Update Destination' : 'Add Destination'; ?></button>
        </form>
    </article>
    <article class="table-card">
        <div class="table-card-head">
            <h2>Destination Library</h2>
        </div>
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Route</th>
                    <th>Tag</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($destinations as $destination): ?>
                    <tr>
                        <td><?php echo e($destination['route']); ?></td>
                        <td><?php echo e($destination['tag']); ?></td>
                        <td class="action-links">
                            <a href="<?php echo e(appUrl('admin/destinations.php')); ?>?edit=<?php echo e($destination['id']); ?>">Edit</a>
                            <a href="<?php echo e(appUrl('admin/destinations.php')); ?>?action=delete&amp;id=<?php echo e($destination['id']); ?>" onclick="return confirm('Delete this destination?');">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </article>
</section>
<?php require __DIR__ . '/partials/bottom.php'; ?>
