$(function () {
	$("#search_project_btn").click(function () {
		const project_name = $("input[name=project_name]").val();
		const project_year = $("input[name=project_year]").val();
		const project_semester = $("input[name=project_semester]").val();
		const group_member_name = $("input[name=group_member_name]").val();

		$.post(
			"searchProject.php",
			{ project_name, project_year, project_semester, group_member_name },
			function (data) {
				data = JSON.parse(data);
				// console.log(data);

				if (data.status === 200) {
					const { projects } = data;
					if (projects.length === 0) {
						alert("No projects found mathching with your filters!");
					} else {
						const projectsEl = document.querySelector("tbody#projects");
						if (!projectsEl) {
							alert("Couldn't find projects table to display. Refreshing page!");
							location.reload();
							return;
						}
						projectsEl.innerHTML = ""; // clear previous results
						projects.forEach((p) => {
							const tr = document.createElement("tr");
							tr.innerHTML = `
                                <td>${p.name}</td>
                                <td>${p.description}</td>
                                <td>${p.year}</td>
                                <td>${p.semester}</td>
                                <td>${p.requirements}</td>
                                <td title="${p.state}">${
								p.state === "accepted"
									? "✅"
									: p.state === "waiting"
									? "⏳"
									: p.state === "rejected"
									? "❌"
									: "❔"
							}</td>
                                <td>${p.required_software}</td>
                                <td>${p.required_hardware}</td>
                                <td>${p.members}</td>
                                ${
									$("#isAdmin").length != 0
										? `
                                    <td>
                                        <form action="editProject.php" method="post">
                                            <input type="text" name="project_id" style="display: none;" value="${p.id}">
                                            <input class="btn" type="submit" name="acceptBtn" value="✅"></input>
                                            <input class="btn" type="submit" name="rejectBtn" value="❌"></input>
                                        </form>
                                    </td>
                                    `
										: ""
								}
                                ${
									$("#canEdit").length != 0
										? `
                                    <td><a href="editProject.php?project_id=${p.id}">Edit</a> | <a href="deleteProject.php?project_id=${p.id}">Delete</a></td>
                                    `
										: ""
								}
                            `;
							projectsEl.appendChild(tr);
						});
					}
				} else {
					alert("Something went wrong while searching for projects! Error: " + data.error);
				}
			}
		);
	});
});
