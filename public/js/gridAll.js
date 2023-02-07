function getGridDataSourceEnv() {
	var sourceGrid = {
		datatype: "json",
		datafields: [
			{ name: "libApp", type: "string" },
			{ name: "codeMoa", type: "string" },
			{ name: "userMatricule", type: "string" },
			{ name: "codePoleAmoa", type: "string" },
			{ name: "codeEntiteAmoa", type: "string" },
			{ name: "codeEquipeAmoa", type: "string" },
			{ name: "codeMoe", type: "string" },
			{ name: "libMoeExt", type: "string" },
			{ name: "typeAppli", type: "string" },
			{ name: "codeEqMoe", type: "string" },
			{ name: "codeUniteMoe", type: "string" },
			{ name: "nomServeur", type: "string" },
			{ name: "devLocaux", type: "bool" },
			{ name: "qualifieSit", type: "bool" },
			{ name: "libStatut", type: "string" },
			{ name: "libReg", type: "string" },
			{ name: "numCyber", type: "int" },
			{ name: "dateReforme", format: "yyyy-MM-dd", type: "date" },
			{ name: "dateFinSup", format: "yyyy-MM-dd", type: "date" },
			{ name: "fluxIn", type: "string" },
			{ name: "fluxOut", type: "string" },
			{ name: "typeAcces", type: "string" },
			{ name: "libBrique", type: "string" },
			{ name: "obsolescence", type: "bool" },
			{ name: "mv", type: "bool" },
			{ name: "portage", type: "bool" },
			{ name: "raisonPortage", type: "text" },
			{ name: "statutSuivi", type: "string" },
			{ name: "dateDebutSuivi", format: "yyyy-MM-dd", type: "date" },
			{ name: "dateFinSuivi", format: "yyyy-MM-dd", type: "date" },
			{ name: "commentairesSuivi", type: "text" },
		],
		url: "../list/applications",
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
	$("#jqxButton_Exporter").jqxButton({
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
  
	$("#jqxgrid_lstAll").jqxGrid({
		width: calculateWidthGrid(1530),
		height: "600px",
		source: getGridDataSourceEnv(),
		theme: "ui-ratp",
		pageable: true,
		pagesize: 50,
		pagesizeoptions: ["5", "10", "20", "50", "100", "200"],
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
				text: "Application",
				datafield: "libApp",
				filtertype: "list",
				width: 250,
			},
			{
				text: "MOA",
				datafield: "codeMoa",
				filtertype: "list",
				width: 100,
			},
			{
				text: "Contact",
				datafield: "userMatricule",
				filtertype: "list",
				width: 100,
			},
			{
				text: "Pôle AMOA",
				datafield: "codePoleAmoa",
				filtertype: "list",
				width: 100,
			},
			{
				text: "Équipe AMOA",
				datafield: "codeEquipeAmoa",
				filtertype: "list",
				width: 120,
			},
			{
				text: "Entité AMOA",
				datafield: "codeEntiteAmoa",
				filtertype: "list",
				width: 120,
			},
			{
				text: "MOE",
				datafield: "codeMoe",
				filtertype: "list",
				width: 100,
			},
			{
				text: "Unité MOE",
				datafield: "codeUniteMoe",
				filtertype: "list",
				width: 100,
			},
			{
				text: "Equipe MOE",
				datafield: "codeEqMoe",
				filtertype: "list",
				width: 100,
			},
			{
				text: "MOE Externe",
				datafield: "libMoeExt",
				filtertype: "list",
				width: 130,
			},
			{
				text: "Statut",
				datafield: "libStatut",
				filtertype: "list",
				width: 120,
			},
			{
				text: "Type d'appli",
				datafield: "typeAppli",
				filtertype: "list",
				width: 110,
			},
			{
				text: "Flux Entrant",
				datafield: "fluxIn",
				filtertype: "list",
				width: 110,
			},
			{
				text: "Flux Sortant",
				datafield: "fluxOut",
				filtertype: "list",
				width: 110,
			},
			{
				text: "Type d'Acces",
				datafield: "typeAcces",
				filtertype: "list",
				width: 110,
			},
			{
				text: "Nom Serveur",
				datafield: "nomServeur",
				filtertype: "list",
				width: 100,
			},
			{
				text: "Dev Locaux?",
				datafield: "devLocaux",
				width: 100,
				columntype: "checkbox",
				filtertype: "bool",
			},
			{
				text: "Qualifié?",
				datafield: "qualifieSit",
				width: 100,
				columntype: "checkbox",
				filtertype: "bool",
			},
			{
				text: "Briques Techniques",
				datafield: "libBrique",
				filtertype: "list",
				width: 200,
			},
			{
				text: "Regroupement",
				datafield: "libReg",
				filtertype: "list",
				width: 150,
			},
			{
				text: "Niveau Criticité",
				datafield: "numCyber",
				filtertype: "list",
				width: 110,
			},
			{
				text: "Date Réforme",
				datafield: "dateReforme",
				filtertype: "range",
				cellsformat: "dd/MM/yyyy",
				width: 120,
			},
			{
				text: "Date fin de support",
				datafield: "dateFinSup",
				filtertype: "range",
				cellsformat: "dd/MM/yyyy",
				width: 170,
			},
			{
				text: "Obsolescence?",
				datafield: "obsolescence",
				width: 110,
				columntype: "checkbox",
				filtertype: "bool",
			},
			{
				text: "Montée Version?",
				datafield: "mv",
				width: 110,
				columntype: "checkbox",
				filtertype: "bool",
			},
			{
				text: "Portage?",
				datafield: "portage",
				width: 110,
				columntype: "checkbox",
				filtertype: "bool",
			},
			{
				text: "Raison Portage",
				datafield: "raisonPortage",
				width: 250,
			},
			{
				text: "Statut du suivi",
				datafield: "statutSuivi",
				filtertype: "list",
				width: 150,
			},
			{
				text: "Date de début",
				datafield: "dateDebutSuivi",
				filtertype: "range",
				cellsformat: "dd/MM/yyyy",
				width: 170,
			},
			{
				text: "Date de fin",
				datafield: "dateFinSuivi",
				filtertype: "range",
				cellsformat: "dd/MM/yyyy",
				width: 170,
			},
			{
				text: "Commentaire(s)",
				datafield: "commentairesSuivi",
				width: 400,
			},
		],
	});

	$("#export_Excel").click(function () {
		$("#jqxgrid_lstAll").jqxGrid("exportdata", "xls", "jqxgrid_lstAll");
	});
});
