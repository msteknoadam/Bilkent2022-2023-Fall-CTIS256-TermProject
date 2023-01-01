<?php
include_once "db.php";
include_once "session.php";

if (!isset($user)) {
    $projects_stmt = $db->prepare("select * from projects order by year desc, semester desc");
    $projects_stmt->execute();
    $projects = $projects_stmt->fetchAll();
}

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
                    <td><button id="search_project_btn">Search</button></td>
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
                <th>Required Softwares</th>
                <th>Required Hardware</th>
                <th>Group Members</th>
            </thead>
            <tbody id="projects">
            <?php foreach ($projects as $project): ?>
                <tr>
                    <td><?=$project["name"]?></td>
                    <td><?=$project["description"]?></td>
                    <td><?=$project["year"]?></td>
                    <td><?=$project["semester"]?></td>
                    <td><?=$project["requirements"]?></td>
                    <td title="<?=$project["state"]?>"><?=$project["state"] === "accepted" ? "✅" : ($project["state"] === "waiting" ? "⏳" : ($project["state"] === "rejected" ? "❌" : "❔"))?></td>
                    <td><?=$project["required_software"]?></td>
                    <td><?=$project["required_hardware"]?></td>
                    <td><?=$project["members"]?></td>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>
        <?php else: ?>
        <h1>No Projects Added Yet!</h1>
        <?php endif;?>
    <?php endif;?>
    <script src="assets/js/index.js"></script>
