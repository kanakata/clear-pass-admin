<div class="search">

    <?php if ($pageData == null): ?>

        <form action="#" method="post">
            <label for="search">
                <img src="./assets/icons/search.png" alt="search">
                <input type="text" name="search_student" placeholder="type student's admission" value="" disabled style="cursor: not-allowed;">
            </label>
            <input type="submit" value="search" name="search" disabled style="cursor: not-allowed;">
        </form>

    <?php else: ?>

        <form action=" #" method="post">
            <label for="search">
                <img src="./assets/icons/search.png" alt="search">
                <input type="text" name="search_student" placeholder="type student's admission" value="">
            </label>
            <input type="submit" value="search" name="search">
        </form>

    <?php endif; ?>

    <div class="searchoutput">
        <table>

            <?php if ($searchData == null): ?>
                <tr>
                    <td colspan="10" style="background: blue; color: white;">Search not performed.</td>
                </tr>
            <?php else: ?>
                <?php if ($_GET['inquiry'] == "view_students"): ?>

                    <thead>
                        <tr>
                            <th>username</th>
                            <th>admission</th>
                            <?php foreach ($departments as $department): ?>
                                <th><?= e($department) ?> status</th>
                            <?php endforeach; ?>
                            <th>genera status</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php foreach ($searchData as $searchInfo): ?>
                            <tr>
                                <td><?= e($searchInfo['username']) ?></td>
                                <td><?= e($searchInfo['admission number']) ?></td>

                                <?php foreach ($departments as $department): ?>
                                    <td style="background:
                                    <?php if ($searchInfo[$department . ' status'] == "cleared") {
                                        echo "rgb(133, 193, 133)";
                                    } elseif ($searchInfo[$department . ' status'] == "uncleared") {
                                        echo "red";
                                    } else {
                                        echo "blue";
                                    }
                                    ?>"><?= e($searchInfo[$department . ' status']); ?></td>
                                <?php endforeach; ?>

                                <td style="background:
                                    <?php if ($searchInfo['clearance status'] == "cleared") {
                                        echo "rgb(133, 193, 133)";
                                    } elseif ($searchInfo['clearance status'] == "uncleared") {
                                        echo "red";
                                    } else {
                                        echo "blue";
                                    }
                                    ?>"><?= e($searchInfo['clearance status']); ?></td>

                            </tr>
                            <tr>
                                <td colspan="10" style="background: rgb(133, 193, 133);">Match found.</td>
                            </tr>
                        <?php endforeach; ?>

                    </tbody>

                <?php elseif ($_GET['inquiry'] == "cleared_general" || $_GET['inquiry'] == "uncleared_general"): ?>
                    <thead>
                        <tr>
                            <th>username</th>
                            <th>admission</th>
                            <?php foreach ($departments as $department): ?>
                                <th><?= e($department) ?> status</th>
                            <?php endforeach; ?>
                            <th>genera status</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php foreach ($searchData as $searchInfo): ?>
                            <tr>
                                <td><?= e($searchInfo['username']) ?></td>
                                <td><?= e($searchInfo['admission number']) ?></td>

                                <?php foreach ($departments as $department): ?>
                                    <td style="background:
                                    <?php if ($searchInfo[$department . ' status'] == "cleared") {
                                        echo "rgb(133, 193, 133)";
                                    } elseif ($searchInfo[$department . ' status'] == "uncleared") {
                                        echo "red";
                                    } else {
                                        echo "blue";
                                    }
                                    ?>"><?= e($searchInfo[$department . ' status']); ?></td>
                                <?php endforeach; ?>

                                <td style="background:
                                    <?php if ($searchInfo['clearance status'] == "cleared") {
                                        echo "rgb(133, 193, 133)";
                                    } elseif ($searchInfo['clearance status'] == "uncleared") {
                                        echo "red";
                                    } else {
                                        echo "blue";
                                    }
                                    ?>"><?= e($searchInfo['clearance status']); ?></td>

                            </tr>
                            <tr>
                                <td colspan="10" style="background: rgb(133, 193, 133);">Match found.</td>
                            </tr>
                        <?php endforeach; ?>

                    </tbody>
                <?php elseif ($_GET['inquiry'] == "view_shipment_details"): ?>

                    <thead>
                        <tr>
                            <th>username</th>
                            <th>admission</th>
                            <th>index</th>
                            <th>location</th>
                            <th>stage</th>
                            <th>date</th>
                            <th>courier</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php foreach ($searchData as $searchInfo): ?>
                            <tr>
                                <!-- <td class="image"><img src="./assets/icons/<?= e($searchInfo['userprofilepic']) ?>" alt=""></td> -->
                                <td><?= e($searchInfo['username']); ?></td>
                                <td><?= e($searchInfo['admission number']) ?></td>
                                <td><?= e($searchInfo['index number']) ?></td>
                                <td><?= e($searchInfo["location"] ?? 'N/A') ?></td>
                                <td><?= e($searchInfo["stage"] ?? 'N/A') ?></td>
                                <td><?= e($searchInfo["date"] ?? 'N/A') ?></td>
                                <td><?= e($searchInfo["courrier"] ?? 'N/A') ?></td>
                            </tr>
                            <tr>
                                <td colspan="10" style="background: rgb(133, 193, 133);">Match found.</td>
                            </tr>
                        <?php endforeach; ?>

                    </tbody>

                <?php else: ?>

                    <thead>
                        <tr>
                            <th>username</th>
                            <th>admission</th>
                            <th>debt</th>
                            <th>value</th>
                            <th>status</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php foreach ($searchData as $searchInfo): ?>
                            <tr>
                                <!-- <td class="image"><img src="./assets/icons/<?= e($searchInfo['userprofilepic']); ?>" alt=""></td> -->
                                <td><?= e($searchInfo['username']); ?></td>
                                <td><?= e($searchInfo['admission number']); ?></td>
                                <td><?= e($searchInfo[$_GET['department'] . " debt"] ?? 'N/A') ?></td>
                                <td><?= e($searchInfo[$_GET['department'] . " value"] ?? 'N/A') ?></td>
                                <td style="background:
                                <?php if ($searchInfo[$_GET['department'] . " status"] == "cleared") {
                                    echo "rgb(133, 193, 133)";
                                } elseif ($searchInfo[$_GET['department'] . " status"] == "uncleared") {
                                    echo "red";
                                } else {
                                    echo "blue";
                                }
                                ?>"><?= e($searchInfo[$_GET['department'] . " status"] ?? 'N/A') ?></td>
                            </tr>
                            <tr>
                                <td colspan="10" style="background: rgb(133, 193, 133);">Match found.</td>
                            </tr>
                        <?php endforeach; ?>

                    </tbody>
                <?php endif; ?>
            <?php endif; ?>
        </table>
    </div>
</div>
