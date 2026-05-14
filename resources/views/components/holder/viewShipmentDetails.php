<div class="check">
    <div class="table">
        <table>
            <thead>
                <tr>
                    <th>username</th>
                    <th>admission</th>
                    <th>index</th>
                    <th>location</th>
                    <th>pic-up stage</th>
                    <th>request date</th>
                    <th>courier</th>
                </tr>
            </thead>

            <tbody>
                <?php if (!empty($pageData)): ?>
                    <?php foreach ($pageData as $info): ?>
                        <tr>
                            <td><?=  e($info['username']); ?></td>
                            <td><?=  e($info['admission number']); ?></td>
                            <td><?=  e($info['index number']); ?></td>
                            <td><?=  e($info['location']); ?></td>
                            <td><?=  e($info['stage']); ?></td>
                            <td><?=  e($info['date']); ?></td>
                            <td><?=  e($info['courrier']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" style="background: red;">No records found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
