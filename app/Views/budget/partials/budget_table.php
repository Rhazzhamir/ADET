<?php if (isset($budgets) && !empty($budgets)) : ?>
    <?php foreach ($budgets as $budget) : ?>
        <tr>
            <td><?= esc($budget['year']) ?></td>
            <td>₱<?= number_format($budget['amount'], 2) ?></td>
            <td>
                <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#editBudgetModal<?= $budget['id'] ?>">
                    <i class="fas fa-edit"></i>
                </button>
                <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteBudgetModal<?= $budget['id'] ?>">
                    <i class="fas fa-trash"></i>
                </button>
            </td>
        </tr>
    <?php endforeach; ?>
<?php else : ?>
    <tr>
        <td colspan="3" class="text-center">No budget records found</td>
    </tr>
<?php endif; ?> 