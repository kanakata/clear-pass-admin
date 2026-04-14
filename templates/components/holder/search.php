<!-- display searched data -->
<div class="search">
    <form action="#" method="post">
        <label for="search">
            <img src="./assets/icons/search.png" alt="search">
            <input type="text" name="search_student" placeholder="type student's admission" value="<?php
                                                                                                    if (isset($_POST['search'])) {
                                                                                                        echo $_POST['search_student'];
                                                                                                    }
                                                                                                    ?>
            ">
        </label>
        <input type="submit" value="search" name="search">
    </form>

    <div class="searchoutput">
        <table>
            <thead>
                <?php if ($_GET['inquiry'] == "view_students"): ?>
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
                    </tr>
                <?php elseif ($_GET['inquiry'] == "view_shipment_details"): ?>
                    <tr>
                        <th>username</th>
                        <th>admission</th>
                        <th>index</th>
                        <th>location</th>
                        <th>stage</th>
                        <th>date</th>
                        <th>courier</th>
                    </tr>
                <?php else: ?>
                    <tr>
                        <th>username</th>
                        <th>admission</th>
                        <th>year</th>
                        <th>debt</th>
                        <th>value</th>
                        <th>status</th>
                    </tr>
                <?php endif; ?>
            </thead>
            <tbody>
                <?php if (isset($_POST['search']) && $search_status !== null): ?>
                    <?php if ($_GET['inquiry'] == "view_students"): ?>
                        <?php foreach ($search_data as $search_info): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($search_info['username']); ?></td>
                                <td><?php echo htmlspecialchars($search_info['admission number']); ?></td>
                                <td><?php echo htmlspecialchars($search_info['year']); ?></td>
                                <td style="background:
                                    <?php if ($search_info['finance status'] == "cleared") {
                                        echo "rgb(133, 193, 133)";
                                    } elseif ($search_info['finance status'] == "uncleared") {
                                        echo "red";
                                    } else {
                                        echo "blue";
                                    }
                                    ?>"><?php echo htmlspecialchars($search_info['finance status']); ?></td>
                                <td style="background:
                                    <?php if ($search_info['accessories status'] == "cleared") {
                                        echo "rgb(133, 193, 133)";
                                    } elseif ($search_info['accessories status'] == "uncleared") {
                                        echo "red";
                                    } else {
                                        echo "blue";
                                    }
                                    ?>"><?php echo htmlspecialchars($search_info['accessories status']); ?></td>
                                <td style="background:
                                    <?php if ($search_info['boarding status'] == "cleared") {
                                        echo "rgb(133, 193, 133)";
                                    } elseif ($search_info['boarding status'] == "uncleared") {
                                        echo "red";
                                    } else {
                                        echo "blue";
                                    }
                                    ?>"><?php echo htmlspecialchars($search_info['boarding status']); ?></td>
                                <td style="background:
                                    <?php if ($search_info['games status'] == "cleared") {
                                        echo "rgb(133, 193, 133)";
                                    } elseif ($search_info['games status'] == "uncleared") {
                                        echo "red";
                                    } else {
                                        echo "blue";
                                    }
                                    ?>"><?php echo htmlspecialchars($search_info['games status']); ?></td>
                                <td style="background:
                                    <?php if ($search_info['laboratory status'] == "cleared") {
                                        echo "rgb(133, 193, 133)";
                                    } elseif ($search_info['laboratory status'] == "uncleared") {
                                        echo "red";
                                    } else {
                                        echo "blue";
                                    }
                                    ?>"><?php echo htmlspecialchars($search_info['laboratory status']); ?></td>
                                <td style="background:
                                    <?php if ($search_info['library status'] == "cleared") {
                                        echo "rgb(133, 193, 133)";
                                    } elseif ($search_info['library status'] == "uncleared") {
                                        echo "red";
                                    } else {
                                        echo "blue";
                                    }
                                    ?>"><?php echo htmlspecialchars($search_info['library status']); ?></td>
                            </tr>
                            <tr>
                                <td colspan="10" style="background: rgb(133, 193, 133);">Match found.</td>
                            </tr>
                        <?php endforeach; ?>
                    <?php elseif ($_GET['inquiry'] == "view_shipment_details"): ?>
                        <?php foreach ($search_data as $search_info): ?>
                            <tr>
                                <!-- <td class="image"><img src="./assets/icons/<?php echo htmlspecialchars($search_info['userprofilepic']); ?>" alt=""></td> -->
                                <td><?php echo htmlspecialchars($search_info['username']); ?></td>
                                <td><?php echo htmlspecialchars($search_info['admission number']); ?></td>
                                <td><?php echo htmlspecialchars($search_info['index number']); ?></td>
                                <td><?php echo $search_info["location"] ?? 'N/A'; ?></td>
                                <td><?php echo $search_info["stage"] ?? 'N/A'; ?></td>
                                <td><?php echo $search_info["date"] ?? 'N/A'; ?></td>
                                <td><?php echo $search_info["courrier"] ?? 'N/A'; ?></td>
                            </tr>
                            <tr>
                                <td colspan="10" style="background: rgb(133, 193, 133);">Match found.</td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <?php foreach ($search_data as $search_info): ?>
                            <tr>
                                <!-- <td class="image"><img src="./assets/icons/<?php echo htmlspecialchars($search_info['userprofilepic']); ?>" alt=""></td> -->
                                <td><?php echo htmlspecialchars($search_info['username']); ?></td>
                                <td><?php echo htmlspecialchars($search_info['admission number']); ?></td>
                                <td><?php echo htmlspecialchars($search_info['year']); ?></td>
                                <td><?php echo $search_info[$_GET['department'] . " debt"] ?? 'N/A'; ?></td>
                                <td><?php echo $search_info[$_GET['department'] . " value"] ?? 'N/A'; ?></td>
                                <td style="background: 
                                <?php if ($search_info[$_GET['department'] . " status"] == "cleared") {
                                    echo "rgb(133, 193, 133)";
                                } elseif ($search_info[$_GET['department'] . " status"] == "uncleared") {
                                    echo "red";
                                } else {
                                    echo "blue";
                                }
                                ?>"><?php echo $search_info[$_GET['department'] . " status"] ?? 'N/A'; ?></td>
                            </tr>
                            <tr>
                                <td colspan="10" style="background: rgb(133, 193, 133);">Match found.</td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                <?php elseif (!isset($_POST['search'])): ?>
                    <tr>
                        <td colspan="10" style="background: blue;">Search not performed.</td>
                    </tr>
                <?php elseif ($search_status == null): ?>
                    <tr>
                        <td colspan="10" style="background: red;">No records found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>