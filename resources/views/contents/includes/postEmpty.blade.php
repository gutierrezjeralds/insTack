@if($posts->isEmpty())
    <div class="alert alert-info text-center">
        <p> No more stories!</p>
    </div>
@else
    <div class="alert alert-info text-center alert-no-more-stories" style="display: none;">
        <p> No more stories!</p>
    </div>
@endif