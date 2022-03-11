var lineChartData = {
    labels: ["January", "February", "March", "April", "May", "June", "July"],
    datasets: [{
        fillColor: "rgba(220,220,220,0.5)",
        strokeColor: "rgba(220,220,220,1)",
        pointColor: "rgba(220,220,220,1)",
        pointStrokeColor: "#fff",
        data: [65, 59, 90, 81, 56, 55, 40],
        bezierCurve: false
    }]

}

function done() {
    //alert("haha");
    var url = myLine.toBase64Image();
    document.getElementById("url3").src = url;
}
var options = {
    bezierCurve: false,
    animation: {
        onComplete: done
    }
};


var myLine = new Chart(document.getElementById("myChart3").getContext("2d"), {
    data: lineChartData,
    type: "line",
    options: options
});