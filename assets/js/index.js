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
