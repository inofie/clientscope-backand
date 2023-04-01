$(document).ready(function(){
    loadLeaderBoard()
    $('.kpi_group_id, .time_frame').change(function(){
        loadLeaderBoard()
    });
})

var loadLeaderBoard = () => {
    ajax_request(window.location.href,'GET',$('#leader_board_form').serialize()).then( (res) => {
        $('#leader_board').html(res);
    });
}
