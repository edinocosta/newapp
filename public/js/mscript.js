angular.module('app', ['ngMaterial', 'ngMessages']).controller('AppCtrl', function() {
  this.myDate = new Date();

  this.minDate = new Date(
    this.myDate.getFullYear(),
    this.myDate.getMonth(),
    this.myDate.getDate()-4
  );
  //alert(this.myDate.getDay());

  this.maxDate = new Date(
    this.myDate.getFullYear(),
    this.myDate.getMonth() ,
    this.myDate.getDate()+4
  );

  this.onlyWeekendsPredicate = function(date) {
    var day = date.getDay();
    return day === 0 || day === 6;
  };
});