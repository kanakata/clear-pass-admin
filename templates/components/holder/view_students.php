<div class="check">
    <div class="table">
        <table>
            <thead>
                <tr>
                    <th>username</th>
                    <th>admission</th>
                    <th>year</th>
                    <th>finance status</th>
                    <th>accessories status</th>
                    <th>boarding status</th>
                    <th>games status</th>
                    <th>laboratory status</th>
                    <th>library status</th>
                    <th>General status</th>
                </tr>
            </thead>

            <tbody>
                <?php if (!empty($page_data)): ?>
                    <?php foreach ($page_data as $info): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($info['username']); ?></td>

                            <td><?php echo htmlspecialchars($info['admission number']); ?></td>

                            <td><?php echo htmlspecialchars($info['year']); ?></td>

                            <td style="background:
                                    <?php if ($info['finance status'] == "cleared") {
                                        echo "rgb(133, 193, 133)";
                                    } elseif ($info['finance status'] == "uncleared") {
                                        echo "red";
                                    } else {
                                        echo "blue";
                                    }
                                    ?>"><?php echo htmlspecialchars($info['finance status']); ?></td>

                            <td style="background:
                                    <?php if ($info['accessories status'] == "cleared") {
                                        echo "rgb(133, 193, 133)";
                                    } elseif ($info['accessories status'] == "uncleared") {
                                        echo "red";
                                    } else {
                                        echo "blue";
                                    }
                                    ?>"><?php echo htmlspecialchars($info['accessories status']); ?></td>

                            <td style="background:
                                    <?php if ($info['boarding status'] == "cleared") {
                                        echo "rgb(133, 193, 133)";
                                    } elseif ($info['boarding status'] == "uncleared") {
                                        echo "red";
                                    } else {
                                        echo "blue";
                                    }
                                    ?>"><?php echo htmlspecialchars($info['boarding status']); ?></td>

                            <td style="background:
                                    <?php if ($info['games status'] == "cleared") {
                                        echo "rgb(133, 193, 133)";
                                    } elseif ($info['games status'] == "uncleared") {
                                        echo "red";
                                    } else {
                                        echo "blue";
                                    }
                                    ?>"><?php echo htmlspecialchars($info['games status']); ?></td>

                            <td style="background:
                                    <?php if ($info['laboratory status'] == "cleared") {
                                        echo "rgb(133, 193, 133)";
                                    } elseif ($info['laboratory status'] == "uncleared") {
                                        echo "red";
                                    } else {
                                        echo "blue";
                                    }
                                    ?>"><?php echo htmlspecialchars($info['laboratory status']); ?></td>

                            <td style="background:
                                    <?php if ($info['library status'] == "cleared") {
                                        echo "rgb(133, 193, 133)";
                                    } elseif ($info['library status'] == "uncleared") {
                                        echo "red";
                                    } else {
                                        echo "blue";
                                    }
                                    ?>"><?php echo htmlspecialchars($info['library status']); ?></td>

                            <td style="background:
                                    <?php if ($info['clearancestatus'] == "cleared") {
                                        echo "rgb(133, 193, 133)";
                                    } elseif ($info['clearancestatus'] == "uncleared") {
                                        echo "red";
                                    } else {
                                        echo "blue";
                                    }
                                    ?>"><?php echo htmlspecialchars($info['clearancestatus']); ?></td>
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