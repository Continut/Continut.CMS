'use strict';

// load the app module and define 'cms' as a dependency to run it
angular.module('continut.app', ['ngRoute', 'ngJsTree', 'continut.cms']).
  config(function ($routeProvider) {
      $routeProvider.when('/start', {
          templateUrl: 'Extensions/System/Editor/Resources/Public/JavaScript/angular/partials/main.html',
          controller: 'EditorController'
      });
      $routeProvider.otherwise({
          redirectTo: '/start'
      });
  });
// load our 'cms' module
angular.module('continut.cms', []);
