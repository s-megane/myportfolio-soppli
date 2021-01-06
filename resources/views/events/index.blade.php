<div class = "row">
    <div class = "col-xs-4 col-md-12">
        
        <div class = "text-center">
        <h1>イベント一覧</h1>    
            <table class="table table-borderless">
                
                <tbody>
                    @foreach($events as $event)
                    <tr>
                        <td><h2>{!! link_to_route("events.show" , $event->eventdate. " " .$event->title , ["event" => $event->id] ,["class" => "text-center"] ) !!}</h2></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
                
    </div>
</div>
@include("users.index")
