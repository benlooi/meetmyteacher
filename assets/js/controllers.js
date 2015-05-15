angular.module('controllers',[])


.controller ('welcomeCtrl', function ($scope,$http,$state){
$scope.user={};
$scope.login = function () {
	$http.get('apis/index.php/welcome/login',{user:$scope.user})
	.success(function (data){
		$scope.loggedinUser=data;
		if ($scope.loggedinUser.role=="teacher") {
			$state.go('teachers');
		} else if ($scope.loggedinUser.role=="student") {
			$state.go('students');
		} else {
			$state.reload();
		}
		localStorage.setItem('loggedinUser',JSON.stringify($scope.loggedinUser));

	})
	.error(function(err){
		console.log(err);
	})
}

})

.controller('teachersCtrl', function($scope,$http,$modal){

	  $scope.today = function() {
    $scope.dt = new Date();
  };
  $scope.today();

  $scope.clear = function () {
    $scope.dt = null;
  };

  // Disable weekend selection
  $scope.disabled = function(date, mode) {
    return ( mode === 'day' && ( date.getDay() === 0 || date.getDay() === 6 ) );
  };

  $scope.toggleMin = function() {
    $scope.minDate = $scope.minDate ? null : new Date();
  };
  $scope.toggleMin();

  $scope.open = function($event) {
    $event.preventDefault();
    $event.stopPropagation();

    $scope.opened = true;
  };

  $scope.dateOptions = {
    formatYear: 'yy',
    startingDay: 1
  };

  $scope.formats = ['dd MMMM yyyy', 'yyyy/MM/dd', 'dd.MM.yyyy', 'shortDate'];
  $scope.format = $scope.formats[0];

  var tomorrow = new Date();
  tomorrow.setDate(tomorrow.getDate() + 1);
  var afterTomorrow = new Date();
  afterTomorrow.setDate(tomorrow.getDate() + 2);
  $scope.events =
    [
      {
        date: tomorrow,
        status: 'full'
      },
      {
        date: afterTomorrow,
        status: 'partially'
      }
    ];

  $scope.getDayClass = function(date, mode) {
    if (mode === 'day') {
      var dayToCheck = new Date(date).setHours(0,0,0,0);

      for (var i=0;i<$scope.events.length;i++){
        var currentDay = new Date($scope.events[i].date).setHours(0,0,0,0);

        if (dayToCheck === currentDay) {
          return $scope.events[i].status;
        }
      }
    }

    return '';
  };

	$scope.consult={};
	$scope.slots = [
{"start_time":"11:00","slot":"11 am to 12 noon"},
{"start_time":"12:00","slot":"12 noon to 1 pm"},
{"start_time":"13:00","slot":"1 pm to 2 pm"},
{"start_time":"14:00","slot":"2 pm to 3 pm"},
{"start_time":"15:00","slot":"3 pm to 4 pm"}
	]

var user= JSON.parse(localStorage.getItem('loggedinUser'));
if (user.role=="teacher") {
	var teacher=user;
}

//modal stuff
						$scope.animationsEnabled = true;

						$scope.open = function (size) {

							var modalInstance = $modal.open({
								animation: $scope.animationsEnabled,
								templateUrl: 'acknowldge_modal.html',
								controller: 'ModalInstanceCtrl',
								size: size
							/*	resolve: {
										items: function () {
										return $scope.items;
										}
								}*/
							});

						/*modalInstance.result.then(function (selectedItem) {
						$scope.selected = selectedItem;
						}, function () {
						$log.info('Modal dismissed at: ' + new Date());
						}); */
						};

						$scope.toggleAnimation = function () {
						$scope.animationsEnabled = !$scope.animationsEnabled;
						};

	$scope.createSlot = function () {



		$http.post('apis/index.php/welcome/createslot',{teacher:teacher,slot:$scope.consult})
		.success(function(data){

			if (data=="slot created") {
				$scope.open(sm);

			} else if (data!=="slot created") {

			}
			

		})
		.error(function(err){
			console.log(err);
		})
	}


})

.controller('ModalInstanceCtrl', function ($scope, $modalInstance) {

  

  $scope.ok = function () {
    $modalInstance.close();
  };

  $scope.cancel = function () {
    $modalInstance.dismiss('cancel');
  };
})

.controller('subjectsCtrl', function($scope){
	
});