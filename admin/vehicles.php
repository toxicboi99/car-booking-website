<?php
$adminPageTitle = 'Vehicle Management';
$adminPage = 'vehicles';

require_once __DIR__ . '/../includes/bootstrap.php';
requireAdmin();

if (($_GET['action'] ?? '') === 'delete' && !empty($_GET['id'])) {
    deleteItem('vehicles', (string) $_GET['id']);
    setFlash('success', 'Vehicle deleted.');
    redirectTo('/admin/vehicles.php');
}

$editing = !empty($_GET['edit']) ? findById('vehicles', (string) $_GET['edit']) : null;

if (isPost()) {
    $payload = [
        'id' => trim($_POST['id'] ?? ''),
        'name' => trim($_POST['name'] ?? ''),
        'slug' => trim($_POST['slug'] ?? ''),
        'capacity' => trim($_POST['capacity'] ?? ''),
        'type' => trim($_POST['type'] ?? ''),
        'summary' => trim($_POST['summary'] ?? ''),
        'highlights' => array_values(array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', (string) ($_POST['highlights'] ?? ''))))),
        'image' => trim($_POST['image'] ?? ''),
        'accent' => trim($_POST['accent'] ?? ''),
    ];

    upsertItem('vehicles', $payload);
    setFlash('success', $payload['id'] ? 'Vehicle updated.' : 'Vehicle added.');
    redirectTo('/admin/vehicles.php');
}

$vehicles = collection('vehicles');
require __DIR__ . '/partials/top.php';
?>
<section class="admin-grid-two">
    <article class="table-card">
        <div class="table-card-head">
            <h2><?php echo $editing ? 'Edit Vehicle' : 'Add Vehicle'; ?></h2>
        </div>
        <form method="post" class="admin-form-grid">
            <input type="hidden" name="id" value="<?php echo e($editing['id'] ?? ''); ?>">
            <label>
                <span>Vehicle Name</span>
                <input type="text" name="name" value="<?php echo e($editing['name'] ?? ''); ?>" required>
            </label>
            <label>
                <span>Slug</span>
                <input type="text" name="slug" value="<?php echo e($editing['slug'] ?? ''); ?>" required>
            </label>
            <label>
                <span>Capacity</span>
                <input type="text" name="capacity" value="<?php echo e($editing['capacity'] ?? ''); ?>" required>
            </label>
            <label>
                <span>Type</span>
                <input type="text" name="type" value="<?php echo e($editing['type'] ?? ''); ?>" required>
            </label>
            <label>
                <span>Accent Label</span>
                <input type="text" name="accent" value="<?php echo e($editing['accent'] ?? ''); ?>" required>
            </label>
            <label>
                <span>Image URL</span>
                <input type="url" name="image" value="<?php echo e($editing['image'] ?? ''); ?>" required>
            </label>
            <label class="full-span">
                <span>Summary</span>
                <textarea name="summary" rows="4" required><?php echo e($editing['summary'] ?? ''); ?></textarea>
            </label>
            <label class="full-span">
                <span>Highlights (one per line)</span>
                <textarea name="highlights" rows="6" required><?php echo e(isset($editing['highlights']) ? implode("\n", $editing['highlights']) : ''); ?></textarea>
            </label>
            <button type="submit" class="button button-primary"><?php echo $editing ? 'Update Vehicle' : 'Add Vehicle'; ?></button>
        </form>
    </article>
    <article class="table-card">
        <div class="table-card-head">
            <h2>Vehicle Library</h2>
        </div>
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Capacity</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($vehicles as $vehicle): ?>
                    <tr>
                        <td><?php echo e($vehicle['name']); ?></td>
                        <td><?php echo e($vehicle['type']); ?></td>
                        <td><?php echo e($vehicle['capacity']); ?></td>
                        <td class="action-links">
                            <a href="<?php echo e(appUrl('admin/vehicles.php')); ?>?edit=<?php echo e($vehicle['id']); ?>">Edit</a>
                            <a href="<?php echo e(appUrl('admin/vehicles.php')); ?>?action=delete&amp;id=<?php echo e($vehicle['id']); ?>" onclick="return confirm('Delete this vehicle?');">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </article>
</section>
<?php require __DIR__ . '/partials/bottom.php'; ?>
