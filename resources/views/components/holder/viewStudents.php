<div class="check">
    <div class="table">
        <table>
            <thead>
                <tr>
                    <th>username</th>
                    <th>admission</th>
                    <?php foreach ($departments as $department): ?>
                        <th><?= e($department) ?> status</th>
                    <?php endforeach; ?>
                    <th>General status</th>
                </tr>
            </thead>

            <tbody>
                <?php if (!empty($pageData)): ?>
                    <?php foreach ($pageData as $info): ?>
                        <tr>
                            <td><?= e($info['username']); ?></td>

                            <td><?= e($info['admission number']); ?></td>

                            <?php foreach ($departments as $department): ?>
                                <td style="background:
                                    <?php if ($info[$department . ' status'] == "cleared") {
                                        echo "rgb(133, 193, 133)";
                                    } elseif ($info[$department . ' status'] == "uncleared") {
                                        echo "red";
                                    } else {
                                        echo "blue";
                                    }
                                    ?>"><?= e($info[$department . ' status']); ?></td>
                            <?php endforeach; ?>

                            <td style="background:
                                    <?php if ($info['clearance status'] == "cleared") {
                                        echo "rgb(133, 193, 133)";
                                    } elseif ($info['clearance status'] == "uncleared") {
                                        echo "red";
                                    } else {
                                        echo "blue";
                                    }
                                    ?>"><?= e($info['clearance status']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="10" style="background: red">No records found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
