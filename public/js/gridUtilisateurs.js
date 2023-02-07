function getGridDataSource() {
	var sourceGrid = {
		datatype: "json",
		datafields: [
			{ name: "user_matricule", type: "string" },
			{ name: "user_nom", type: "string" },
			{ name: "user_prenom", type: "string" },
			{ name: "profil_lib", type: "string" },
		],
		url: "../list/utilisateurs",
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

$("#jqxButton_Exporter4").jqxButton({
	width: "150",
	height: "25",
	theme: "ui-ratp",
});

$("#jqxButton_Rafraichir2").jqxButton({
	width: "150",
	height: "25",
	theme: "ui-ratp",
});

$("#jqxButton_Admin2").jqxButton({
	width: "150",
	height: "25",
	theme: "ui-ratp",
});

$(document).ready(function () {
	$("#jqxgrid_lstUtilisateurs").jqxGrid({
		width: calculateWidthGrid(540),
		height: "600px",
		source: getGridDataSource(),
		theme: "ui-ratp",
		autoshowloadelement: true,
		autoheight: false,
		showtoolbar: true,
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
				text: "Compte matriculaire",
				datafield: "user_matricule",
				filtertype: "list",
				width: 150,
			},
			{
				text: "Nom",
				datafield: "user_nom",
				filtertype: "list",
				width: 120,
			},
			{
				text: "Prénom",
				datafield: "user_prenom",
				filtertype: "list",
				width: 120,
			},
			{
				text: "Rôle",
				datafield: "profil_lib",
				filtertype: "list",
				width: 150,
			},
		],
	});
});
