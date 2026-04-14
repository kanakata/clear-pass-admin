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
                <?php if (!empty($page_data)): ?>
                    <?php foreach ($page_data as $info): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($info['username']); ?></td>
                            <td><?php echo htmlspecialchars($info['admission number']); ?></td>
                            <td><?php echo htmlspecialchars($info['index number']); ?></td>
                            <td><?php echo htmlspecialchars($info['location']); ?></td>
                            <td><?php echo htmlspecialchars($info['stage']); ?></td>
                            <td><?php echo htmlspecialchars($info['date']); ?></td>
                            <td><?php echo htmlspecialchars($info['courrier']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7">No records found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>