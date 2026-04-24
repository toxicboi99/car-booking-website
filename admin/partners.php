<?php
$adminPageTitle = 'Partner Lead Management';
$adminPage = 'partners';

require_once __DIR__ . '/../includes/bootstrap.php';
requireAdmin();

if (isPost()) {
    $leadId = trim($_POST['lead_id'] ?? '');
    $status = trim($_POST['status'] ?? 'new');
    $partners = collection('partners');

    foreach ($partners as &$partner) {
        if (($partner['id'] ?? '') === $leadId) {
            $partner['status'] = $status;
            break;
        }
    }
    unset($partner);

    saveCollection('partners', $partners);
    setFlash('success', 'Lead status updated.');
    redirectTo('/admin/partners.php');
}

$partners = sortByDateDesc(collection('partners'));
require __DIR__ . '/partials/top.php';
?>
<section class="table-card">
    <div class="table-card-head">
        <h2>Partner Leads</h2>
    </div>
    <table class="admin-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Contact</th>
                <th>City</th>
                <th>Category</th>
                <th>Comments</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($partners as $partner): ?>
                <tr>
                    <td><?php echo e($partner['name']); ?></td>
                    <td>
                        <strong><?php echo e($partner['phone']); ?></strong>
                        <span><?php echo e($partner['email']); ?></span>
                    </td>
                    <td><?php echo e($partner['city']); ?></td>
                    <td><?php echo e($partner['category']); ?></td>
                    <td><?php echo e($partner['comments']); ?></td>
                    <td>
                        <form method="post" class="inline-form">
                            <input type="hidden" name="lead_id" value="<?php echo e($partner['id']); ?>">
                            <select name="status">
                                <?php foreach (['new', 'contacted', 'qualified', 'closed'] as $status): ?>
                                    <option value="<?php echo e($status); ?>" <?php echo ($partner['status'] ?? 'new') === $status ? 'selected' : ''; ?>><?php echo e(ucfirst($status)); ?></option>
                                <?php endforeach; ?>
                            </select>
                            <button type="submit" class="button button-ghost">Update</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</section>
<?php require __DIR__ . '/partials/bottom.php'; ?>
