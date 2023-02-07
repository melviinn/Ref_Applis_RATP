function getGridDataSourceAppli() {
	var faille_id = $("#faille_id").val();
	var sourceGrid = {
		datatype: "json",
		datafields: [
			{ name: "id", type: "int" },
			{ name: "application", type: "string" },
			{ name: "code_moa", type: "string" },
			{ name: "lib_moa", type: "string" },
		],
		id: "faille_id",
		url: "/list/details/failles",
		data: { faille_id: faille_id },
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
	$("#jqxButton_RafraichirFailles1").jqxButton({
		width: "150",
		height: "25",
		theme: "ui-ratp",
	});

	$("#jqxButton_AdminFailles1").jqxButton({
		width: "150",
		height: "25",
		theme: "ui-ratp",
	});

	$("#jqxButton_RetourFailles").jqxButton({
		width: "150",
		height: "25",
		theme: "ui-ratp",
	});

	$("#jqxgrid_detailsFailles").jqxGrid({
		width: calculateWidthGrid(995),
		height: "400px",
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
				text: "Application(s) impactée(s)",
				datafield: "application",
				filtertype: "list",
				width: 180,
			},
			{
				text: "MOA",
				datafield: "code_moa",
				filtertype: "list",
				width: 150,
			},
			{
				text: "Libellé MOA",
				datafield: "lib_moa",
				filtertype: "list",
				cellsrenderer: function (row, column, value) {
					var moa = $("#jqxgrid_detailsFailles").jqxGrid(
						"getcellvalue",
						row,
						"code_moa"
					);
					return (
						"<div class='ml-1 mt-1'><a> " +
						moa +
						"  " +
						value +
						" </a></div>"
					);
				},
				width: 305,
			},
			{
				text: "Traitement",
				//datafield: "null",
				filtertype: "list",
				width: 160,
			},
			{
				text: "Commentaire(s)",
				//datafield: "null",
				width: 200,
			},
		],
	});
});
