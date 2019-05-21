'use strict';

// definieren eines Moduls
var angular_module=angular.module("Search", []);

// hinzufügen eines Controllers zum Modul
angular_module.controller("Search", function ($scope) {
   $scope.search_tag = "";
});