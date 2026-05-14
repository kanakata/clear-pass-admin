<div class="check">
    <div class="table">
        <table>
            <thead>
                <tr>
                    <th>username</th>
                    <th>admission</th>
                    <th>year</th>
                    <th>debt</th>
                    <th>value</th>
                    <th>status</th>
                </tr>
            </thead>

            <tbody>
                <?php if (!empty($pageData)): ?>
                    <?php foreach ($pageData as $info): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($info['username']) ?? "N\A" ?></td>
                            <td><?php echo htmlspecialchars($info['admission number']) ?? "N\A" ?></td>
                            <td><?php echo htmlspecialchars($info['year']) ?? "N\A" ?></td>
                            <td><?php echo $info[$_GET['department'] . " debt"] ?? 'N/A'; ?></td>
                            <td><?php echo $info[$_GET['department'] . " value"] ?? 'N/A'; ?></td>
                            <td
                                style="color: black; background:
                                <?php if ($info[$_GET['department'] . " status"] == "cleared") {
                                    echo "rgb(133, 193, 133)";
                                } elseif ($info[$_GET['department'] . " status"] == "uncleared") {
                                    echo "red";
                                } elseif ($info[$_GET['department'] . " status"] == "online") {
                                    echo "yellow";
                                } else {
                                    echo "blue";
                                }
                                ?>"><?php echo $info[$_GET['department'] . " status"] ?? 'N/A'; ?></td>
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
