$(document).ready(function(){
    $("#filter-search").keyup(function() {
        searchGPUs();
    });

    function searchGPUs() {
        var filter = $("#filter-search").val(), count = 0;
        $(".gpu-listing").each(function(){
            if ($(this).text().search(new RegExp(filter, "i")) < 0) {
                $(this).hide();
            } else {
                $(this).show();
                count++;
            }
        });
        var numberItems = count;
        $("#filter-count").text("Matches: "+count);
    }
    searchGPUs();

});