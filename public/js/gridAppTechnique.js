function getGridDataSourceTechniques() {
	var sourceGrid = {
		datatype: "json",
		datafields: [
			{ name: "app_lib", type: "string" },
			{ name: "env_nomServeur", type: "string" },
			{ name: "env_typeAppli", type: "string" },
			{ name: "site_code", type: "string" },
			{ name: "env_devLocaux", type: "bool" },
			{ name: "env_qualifie", type: "bool" },
			{ name: "brq_lib", type: "string" },
			{ name: "env_impactOS", type: "bool" },
			{ name: "env_impactO365", type: "bool" },
			{ name: "env_impactReorg", type: "bool" },
			{ name: "env_impactProjet", type: "bool" },
			{ name: "env_fluxIn", type: "string" },
			{ name: "env_fluxOut", type: "string" },
			{
				name: "env_dateReforme",
				type: "date",
				format: "yyyy-MM-dd",
			},
			{
				name: "env_dateFinSup",
				type: "date",
				format: "yyyy-MM-dd",
			},
			{ name: "suivi_obs", type: "bool" },
			{ name: "suivi_mv", type: "bool" },
			{ name: "suivi_portage", type: "bool" },
			{ name: "suivi_raisonPor", type: "text" },
			{
				name: "suivi_dateDebut",
				type: "date",
				format: "yyyy-MM-dd",
			},
			{
				name: "suivi_dateFin",
				type: "date",
				format: "yyyy-MM-dd",
			},
			{ name: "suivi_commentaires", type: "text" },
		],
		url: "../list/applications/techniques",
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
	$("#jqxButton_Exporter3").jqxButton({
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
	$("#jqxgrid_lstAppsTecniques").jqxGrid({
		width: calculateWidthGrid(1530),
		height: "600px",
		source: getGridDataSourceTechniques(),
		theme: "ui-ratp",
		pageable: true,
		pagesize: 50,
		pagesizeoptions: ["5", "10", "20", "50", "100", "200"],
		autoshowloadelement: true,
		showtoolbar: true,
		autoheight: false,
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
				columngroup: "Env",
				filtertype: "list",
				datafield: "app_lib",
				width: 250,
			},
			{
				text: "Nom Serveur",
				columngroup: "Env",
				filtertype: "list",
				datafield: "env_nomServeur",
				width: 120,
			},
			{
				text: "Type d'Appli",
				columngroup: "Env",
				filtertype: "list",
				datafield: "env_typeAppli",
				width: 150,
			},
			{
				text: "Site",
				columngroup: "Site",
				filtertype: "list",
				datafield: "site_code",
				width: 120,
			},
			{
				text: "Dev Locaux?",
				columngroup: "Env",
				columntype: "checkbox",
				filtertype: "bool",
				datafield: "env_devLocaux",
				width: 130,
			},
			{
				text: "Qualifié?",
				columngroup: "Env",
				columntype: "checkbox",
				filtertype: "bool",
				datafield: "env_qualifie",
				width: 130,
			},
			{
				text: "Briques techniques",
				columngroup: "Briques",
				filtertype: "list",
				datafield: "brq_lib",
				width: 200,
			},
			{
				text: "Flux entrant",
				filtertype: "list",
				datafield: "env_fluxIn",
				width: 120,
			},
			{
				text: "Flux sortant",
				filtertype: "list",
				datafield: "env_fluxOut",
				width: 120,
			},
			{
				text: "Impact MV OS?",
				columngroup: "Env",
				columntype: "checkbox",
				filtertype: "bool",
				datafield: "env_impactOS",
				width: 130,
			},
			{
				text: "Impact O365?",
				columngroup: "Env",
				columntype: "checkbox",
				filtertype: "bool",
				datafield: "env_impactO365",
				width: 130,
			},
			{
				text: "Impact Reorg?",
				columngroup: "Env",
				columntype: "checkbox",
				filtertype: "bool",
				datafield: "env_impactReorg",
				width: 130,
			},
			{
				text: "Impact Projet?",
				columngroup: "Env",
				columntype: "checkbox",
				filtertype: "bool",
				datafield: "env_impactProjet",
				width: 130,
			},
			{
				text: "Date Réforme",
				datafield: "env_dateReforme",
				filtertype: "range",
				cellsformat: "dd/MM/yyyy",
				width: 130,
			},
			{
				text: "Date Fin Support",
				datafield: "env_dateFinSup",
				filtertype: "range",
				cellsformat: "dd/MM/yyyy",
				width: 130,
			},
			{
				text: "Obsolescence?",
				columngroup: "Suivi",
				columntype: "checkbox",
				filtertype: "bool",
				datafield: "suivi_obs",
				width: 130,
			},
			{
				text: "Montée de Version?",
				columngroup: "Suivi",
				columntype: "checkbox",
				filtertype: "bool",
				datafield: "suivi_mv",
				width: 150,
			},
			{
				text: "Portage Technique?",
				columngroup: "Suivi",
				columntype: "checkbox",
				filtertype: "bool",
				datafield: "suivi_portage",
				width: 140,
			},
			{
				text: "Raison Portage",
				columngroup: "Suivi",
				datafield: "suivi_raisonPor",
				width: 150,
			},
			{
				text: "Date Début Suivi",
				columngroup: "Suivi",
				datafield: "suivi_dateDebut",
				filtertype: "range",
				cellsformat: "dd/MM/yyyy",
				width: 150,
			},
			{
				text: "Date Fin Suivi",
				columngroup: "Env",
				datafield: "suivi_dateFin",
				filtertype: "range",
				cellsformat: "dd/MM/yyyy",
				width: 150,
			},
			{
				text: "Commentaire(s)",
				columngroup: "Suivi",
				datafield: "suivi_commentaires",
				width: 250,
			},
		],
	});
});
