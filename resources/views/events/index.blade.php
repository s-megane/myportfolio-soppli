    
    <div class = "col-sm-12 col-md-8">
        <div class = "text-center">
        <h1>イベント一覧</h1>    
            <table class="table table-borderless">
                <tbody>
                    @foreach($events as $event)
                    <tr>
                        <td><h2>{!! link_to_route("events.show" , $event->eventdate. " " .$event->title , ["event" => $event->id] ,["class" => "text-center mylink"] ) !!}</h2></td>
                    </tr>
                    @endforeach
                </tbody>
                {{ $events->links() }}
            </table>
        </div>
    </div>


