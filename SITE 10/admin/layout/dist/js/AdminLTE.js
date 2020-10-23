(function ($, AdminLTE) {

	"use strict";

	var my_skins = [
	"skin-blue"
	];

	//Create the new tab
	var tab_pane = $("<div />", {
		"id": "control-sidebar-theme-atualstudio-options-tab",
		"class": "tab-pane active"
	});

	//Create the tab button
	var tab_button = $("<li />", {"class": "active"})
	.html("<a href='#control-sidebar-theme-atualstudio-options-tab' data-toggle='tab'>"
	+ "<i class='fa fa-wrench'></i>"
	+ "</a>");

	//Add the tab button to the right sidebar tabs
	$("[href='#control-sidebar-home-tab']")
	.parent()
	.before(tab_button);

	//Create the menu
	var atualstudio_settings = $("<div />");

	//Layout options
	atualstudio_settings.append(
	"<h4 class='control-sidebar-heading'>"
	+ "Opções do Layout"
	+ "</h4>"
	//Boxed layout
	+ "<div class='form-group'>"
	+ "<label class='control-sidebar-subheading'>"
	+ "<input type='checkbox' data-layout='layout-boxed'class='pull-right'/> "
	+ "Boxed Layout"
	+ "</label>"
	+ "<p>Layout com largura pré-definida</p>"
	+ "</div>"
	//Sidebar Toggle
	+ "<div class='form-group'>"
	+ "<label class='control-sidebar-subheading'>"
	+ "<input type='checkbox' data-layout='sidebar-collapse' class='pull-right'/> "
	+ "Esconder Menu"
	+ "</label>"
	+ "<p>Minimiza o menu lateral, exibindo apenas ícones</p>"
	+ "</div>"
	);
	var skins_list = $("<ul />", {"class": 'list-unstyled clearfix'});

	//Dark sidebar skins
	var skin_blue =
	$("<li />", {style: "float:left; width: 33.33333%; padding: 5px;"})
	.append("<a href='javascript:void(0);' data-skin='skin-blue' style='display: block; box-shadow: 0 0 3px rgba(0,0,0,0.4)' class='clearfix full-opacity-hover'>"
	+ "<div><span style='display:block; width: 20%; float: left; height: 7px; background: #367fa9;'></span><span class='bg-light-blue' style='display:block; width: 80%; float: left; height: 7px;'></span></div>"
	+ "<div><span style='display:block; width: 20%; float: left; height: 20px; background: #222d32;'></span><span style='display:block; width: 80%; float: left; height: 20px; background: #f4f5f7;'></span></div>"
	+ "</a>"
	+ "<p class='text-center no-margin'>Blue</p>");
	skins_list.append(skin_blue);

	tab_pane.append(atualstudio_settings);
	$("#control-sidebar-home-tab").after(tab_pane);

	setup();

	/**
	* Toggles layout classes
	*
	* @param String cls the layout class to toggle
	* @returns void
	*/
	function change_layout(cls) {
		$("body").toggleClass(cls);
		AdminLTE.layout.fixSidebar();
		//Fix the problem with right sidebar and layout boxed
		if (cls == "layout-boxed")
		AdminLTE.controlSidebar._fix($(".control-sidebar-bg"));
		if ($('body').hasClass('fixed') && cls == 'fixed') {
			AdminLTE.pushMenu.expandOnHover();
			AdminLTE.layout.activate();
		}
		AdminLTE.controlSidebar._fix($(".control-sidebar-bg"));
		AdminLTE.controlSidebar._fix($(".control-sidebar"));
	}

	/**
	* Replaces the old skin with the new skin
	* @param String cls the new skin class
	* @returns Boolean false to prevent link's default action
	*/
	function change_skin(cls) {
		$.each(my_skins, function (i) {
			$("body").removeClass(my_skins[i]);
		});

		$("body").addClass(cls);
		store('skin', cls);
		return false;
	}

	/**
	* Store a new settings in the browser
	*
	* @param String name Name of the setting
	* @param String val Value of the setting
	* @returns void
	*/
	function store(name, val) {
		if (typeof (Storage) !== "undefined") {
			localStorage.setItem(name, val);
		} else {
			window.alert('Please use a modern browser to properly view this template!');
		}
	}

	/**
	* Get a prestored setting
	*
	* @param String name Name of of the setting
	* @returns String The value of the setting | null
	*/
	function get(name) {
		if (typeof (Storage) !== "undefined") {
			return localStorage.getItem(name);
		} else {
			window.alert('Please use a modern browser to properly view this template!');
		}
	}

	/**
	* Retrieve default settings and apply them to the template
	*
	* @returns void
	*/
	function setup() {
		var tmp = get('skin');
		if (tmp && $.inArray(tmp, my_skins))
		change_skin(tmp);

		//Add the change skin listener
		$("[data-skin]").on('click', function (e) {
			e.preventDefault();
			change_skin($(this).data('skin'));
		});

		//Add the layout manager
		$("[data-layout]").on('click', function () {
			change_layout($(this).data('layout'));
		});

		$("[data-controlsidebar]").on('click', function () {
			change_layout($(this).data('controlsidebar'));
			var slide = !AdminLTE.options.controlSidebarOptions.slide;
			AdminLTE.options.controlSidebarOptions.slide = slide;
			if (!slide)
			$('.control-sidebar').removeClass('control-sidebar-open');
		});

		$("[data-sidebarskin='toggle']").on('click', function () {
			var sidebar = $(".control-sidebar");
			if (sidebar.hasClass("control-sidebar-dark")) {
				sidebar.removeClass("control-sidebar-dark")
				sidebar.addClass("control-sidebar-light")
			} else {
				sidebar.removeClass("control-sidebar-light")
				sidebar.addClass("control-sidebar-dark")
			}
		});

		$("[data-enable='expandOnHover']").on('click', function () {
			$(this).attr('disabled', true);
			AdminLTE.pushMenu.expandOnHover();
			if (!$('body').hasClass('sidebar-collapse'))
			$("[data-layout='sidebar-collapse']").click();
		});

		// Reset options
		if ($('body').hasClass('fixed')) {
			$("[data-layout='fixed']").attr('checked', 'checked');
		}
		if ($('body').hasClass('layout-boxed')) {
			$("[data-layout='layout-boxed']").attr('checked', 'checked');
		}
		if ($('body').hasClass('sidebar-collapse')) {
			$("[data-layout='sidebar-collapse']").attr('checked', 'checked');
		}

	}
})(jQuery, $.AdminLTE);
