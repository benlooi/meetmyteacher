angular.module('cherApp', ['controllers', 'ui.router','ui.bootstrap'])
.config(function($stateProvider,$urlRouterProvider){

	$stateProvider
	.state('welcome', {
		url:"/welcome",
		templateUrl:"templates/welcome.html",
		controller: "welcomeCtrl"
 
	})
	
	.state('teachers', {
		url:"/teachers",
		templateUrl:"templates/teacher_createslot.html",
		controller: "teachersCtrl"
 
	})
	.state('subjects', {
		url:"/subjects",
		templateUrl:"templates/subjects.html",
		controller: "subjectsCtrl"
 
	});
	
/*	.state('loggedin', {
		url:"/loggedin",
		abstract: true,
		templateUrl:"templates/main.html",
		controller: 'mainCtrl',
	

	})
	.state('loggedin.overview', {
url:"/overview",
views: {
	'main-display@loggedin':{
							templateUrl:"templates/overview.html",
							controller: 'overviewCtrl'},
	'right-display@loggedin':{
							templateUrl:"templates/details.html",
							controller: 'detailsCtrl'},
}
		
		})*/

$urlRouterProvider.otherwise('/welcome');
});