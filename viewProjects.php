<?php
include_once "db.php";
include_once "session.php";

$sql = "select * from projects";
$params = array();

if (isset($user) && $user["userclass"] != "admin") {
    $sql = $sql . " where owner_uid=?";
    $params[] = $user["id"];
}

$sql = $sql . " order by year desc, semester desc";

$projects_stmt = $db->prepare($sql);
$projects_stmt->execute($params);
$projects = $projects_stmt->fetchAll();

$isAdmin = isset($user) && $user["userclass"] === "admin";
$canEdit = isset($user) && in_array($user["userclass"], ["firm", "instructor", "student"]);

?>

<?php if (isset($projects)): ?>
        <?php if (sizeof($projects) > 0): ?>
        <h2>Search Projects</h2>
        <table>
            <thead>
                <th>Project Name</th>
                <th>Project Year</th>
                <th>Project Semester</th>
                <th>Group Member Name</th>
                <th></th>
            </thead>
            <tbody>
                <tr>
                    <td><input type="text" name="project_name"></td>
                    <td><input type="text" name="project_year"></td>
                    <td><input type="text" name="project_semester"></td>
                    <td><input type="text" name="group_member_name"></td>
                    <td><button class="btn" id="search_project_btn">Search</button></td>
                </tr>
            </tbody>
        </table>
        <h2>Projects</h2>
        <table>
            <thead>
                <th>Project Name</th>
                <th>Project Description</th>
                <th>Project Year</th>
                <th>Project Semester</th>
                <th>Project Requirements</th>
                <th>Project State</th>
                <th>Required Software</th>
                <th>Required Hardware</th>
                <th>Group Members</th>
                <?php if ($isAdmin): ?>
                <th id="isAdmin>Accept/Reject</th>
                <?php endif;?>
                <?php if ($canEdit): ?>
                <th id="canEdit">Edit/Delete</th>
                <?php endif;?>
            </thead>
            <tbody id="projects">
            <?php foreach ($projects as $project): ?>
                <tr>
                    <td><?=$project["name"]?></td>
                    <td><?=$project["description"]?></td>
                    <td><?=$project["year"]?></td>
                    <td><?=$project["semester"]?></td>
                    <td><?=$project["requirements"]?></td>
                    <td title="<?=$project["state"]?>"><?=$project["state"] === "accepted" ? "???" : ($project["state"] === "waiting" ? "???" : ($project["state"] === "rejected" ? "???" : "???"))?></td>
                    <td><?=$project["required_software"]?></td>
                    <td><?=$project["required_hardware"]?></td>
                    <td><?=$project["members"]?></td>
                    <?php if ($isAdmin && $project["state"] == "waiting"): ?>
                        <td>
                            <form action="editProject.php" method="post">
                                <input type="text" name="project_id" style="display: none;" value="<?=$project["id"]?>">
                                <input class="btn" type="submit" name="acceptBtn" value="???"></input>
                                <input class="btn" type="submit" name="rejectBtn" value="???"></input>
                            </form>
                        </td>
                    <?php endif;?>
                    <?php if ($canEdit): ?>
                    <td><a href="editProject.php?project_id=<?=$project["id"]?>">Edit</a> | <a href="deleteProject.php?project_id=<?=$project["id"]?>">Delete</a></td>
                    <?php endif;?>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>
        <?php else: ?>
        <h1>No Projects Added Yet!</h1>
        <?php endif;?>
<?php endif;?>
<script src="assets/js/index.js"></script>
