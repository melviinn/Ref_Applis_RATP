function getGridDataSourceAppli() {
	var sourceGrid = {
		datatype: "json",
		datafields: [
			{ name: "appl_lib", type: "string" },
			{ name: "moa_code", type: "string" },
			{ name: "user_matricule", type: "string" },
			{ name: "amoa_codePole", type: "string" },
			{ name: "amoa_codeEntite", type: "string" },
			{ name: "amoa_codeEquipe", type: "string" },
			{ name: "moe_code", type: "string" },
			{ name: "moeext_lib", type: "string" },
			{ name: "moeint_codeEquipe", type: "string" },
			{ name: "moeint_codeUnite", type: "string" },
			{ name: "sta_lib", type: "string" },
			{ name: "reg_lib", type: "string" },
			{ name: "admin_matricule", type: "string" },
			{ name: "appl_commentaires", type: "text" },
			{ name: "admin_matricule", type: "text" },
		],
		url: "../list/applications/fonctionnelles",
	};

	var dataAdapterGrid = new $.jqx.dataAdapter(sourceGrid);

	return dataAdapterGrid;
}

function calculateWidthGrid(widthGrid) {
	var widthScreen = $(window).width() - 40;

	//console.log(widthScreen);
	//console.log(widthGrid);

	if (widthScreen > widthGrid) {
		//console.log('return ' + widthGrid);
		return widthGrid;
	} else {
		//console.log('return ' + widthScreen);
		return widthScreen;
	}
}

$(document).ready(function () {
	$("#jqxButton_Exporter2").jqxButton({
		width: "150",
		height: "25",
		theme: "ui-ratp",
	});

	$("#jqxButton_Rafraichir").jqxButton({
		width: "150",
		height: "25",
		theme: "ui-ratp",
	});

	$("#jqxButton_Admin").jqxButton({
		width: "150",
		height: "25",
		theme: "ui-ratp",
	});
	$("#jqxgrid_lstAppsFonctio").jqxGrid({
		width: calculateWidthGrid(1530),
		height: "600px",
		source: getGridDataSourceAppli(),
		theme: "ui-ratp",
		pageable: true,
		pagesize: 50,
		pagesizeoptions: ["5", "10", "20", "50", "100", "200"],
		autoshowloadelement: true,
		autoheight: false,
		showtoolbar: true,
		scrollmode: "logical",
		sortable: true,
		altrows: true,
		enabletooltips: true,
		editable: false,
		selectionmode: "singlerow",
		editmode: "selectedrow",
		showfilterrow: true,
		filterable: true,
		localization: getLocalization("fr"),
		columns: [
			{
				text: "Application",
				datafield: "appl_lib",
				filtertype: "list",
				width: 250,
			},
			{
				text: "MOA",
				datafield: "moa_code",
				filtertype: "list",
				width: 80,
			},
			{
				text: "Contact",
				datafield: "user_matricule",
				filtertype: "list",
				width: 80,
			},
			{
				text: "Pôle AMOA",
				datafield: "amoa_codePole",
				filtertype: "list",
				width: 80,
			},
			{
				text: "Équipe AMOA",
				datafield: "amoa_codeEquipe",
				filtertype: "list",
				width: 100,
			},
			{
				text: "Entité AMOA",
				datafield: "amoa_codeEntite",
				filtertype: "list",
				width: 100,
			},
			{
				text: "MOE",
				datafield: "moe_code",
				filtertype: "list",
				width: 100,
			},
			{
				text: "MOE Externe",
				datafield: "moeext_lib",
				filtertype: "list",
				width: 130,
			},
			{
				text: "Équipe MOE",
				datafield: "moeint_codeEquipe",
				filtertype: "list",
				width: 90,
			},
			{
				text: "Unité MOE",
				datafield: "moeint_codeUnite",
				filtertype: "list",
				width: 100,
			},
			{
				text: "Statut",
				datafield: "sta_lib",
				filtertype: "list",
				width: 120,
			},
			{
				text: "Admin",
				datafield: "admin_matricule",
				filtertype: "list",
				width: 100,
			},
			{
				text: "Regroupement",
				datafield: "reg_lib",
				filtertype: "list",
				width: 150,
			},
			{
				text: "Commentaire(s)",
				datafield: "appl_commentaires",
				width: 500,
			},
		],
	});
});
