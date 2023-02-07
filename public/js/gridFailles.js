function getGridDataSourceAppli() {
	var sourceGrid = {
		datatype: "json",
		datafields: [
			{ name: "failles_id", type: "int" },
			{ name: "nbApps", type: "int" },
			{ name: "failles_lib", type: "string" },
			{ name: "failles_comp", type: "string" },
			{
				name: "failles_date",
				type: "date",
				format: "yyyy-MM-dd",
			},
			{ name: "failles_statut", type: "string" },
			{
				name: "failles_date_fermeture",
				type: "date",
				format: "yyyy-MM-dd",
			},
		],
		url: "../list/failles",
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
	$("#jqxButton_ExporterFailles").jqxButton({
		width: "150",
		height: "25",
		theme: "ui-ratp",
	});

	$("#jqxButton_RafraichirFailles").jqxButton({
		width: "150",
		height: "25",
		theme: "ui-ratp",
	});

	$("#jqxButton_AdminFailles").jqxButton({
		width: "150",
		height: "25",
		theme: "ui-ratp",
	});

	$("#jqxgrid_lstFailles").jqxGrid({
		width: calculateWidthGrid(950),
		height: "600px",
		source: getGridDataSourceAppli(),
		theme: "ui-ratp",
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
				text: "Vulnérabilités",
				datafield: "failles_lib",
				filtertype: "list",
				cellsrenderer: function (row, column, value) {
					var failles_id = $("#jqxgrid_lstFailles").jqxGrid(
						"getcellvalue",
						row,
						"failles_id"
					);
					return (
						'<div style="width: 99%; height: 99%; text-align: left; padding: 6px 2px 4px 4px;" class="link" ><a id="link" style="text-decoration: underline;" href="/details/failles/' +
						failles_id +
						'" class="linkFailles"> ' +
						value +
						" </a></div>"
					);
				},
				width: 130,
			},
			{
				text: "Composant impacté",
				datafield: "failles_comp",
				filtertype: "list",
				width: 150,
			},
			{
				text: "Date d'identification",
				datafield: "failles_date",
				cellsformat: "dd/MM/yyyy",
				filtertype: "range",
				width: 180,
			},
			{
				text: "Nb applications impactées",
				datafield: "nbApps",
				filtertype: "list",
				cellsrenderer: function (row, column, value) {
					return (
						'<div style="width: 99%; height: 99%; text-align: left; padding: 6px 2px 4px 4px;">' +
						value +
						" impactées" +
						" </div>"
					);
				},
				width: 170,
			},
			{
				text: "Statut du traitement",
				datafield: "failles_statut",
				filtertype: "list",
				width: 140,
			},
			{
				text: "Date de traitement",
				datafield: "failles_date_fermeture",
				filtertype: "range",
				cellsformat: "dd/MM/yyyy",
				width: 180,
			},
		],
	});
});
