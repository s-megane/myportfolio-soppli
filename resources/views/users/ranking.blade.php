
<div class = "mb-4"></div>
    <div class="row justify-content-around">
        <div class="col-sm-7">
            <div class = "text-center">
                <div id="example-2" class="carousel slide" data-interval=5000 data-ride="carousel" data-pause=false >
                    <div class="carousel-inner border border-danger">
                        <div class="carousel-item active">
                            <h3>打率ランキング</h3>
                            <table class="table table-borderless  table-striped">
                                <tbody>
                                    @foreach($aveColl as $coll)
                                    <tr>
                                        <td class = 'rank'><h5>{{$coll['rank']}}</h5></td>
                                        <td><h5>{{$coll['name']}}</h5></td>
                                        <td><h5 class = 'ave'>{{$coll['ave']}}</h5></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                             
                        </div>
                        <div class="carousel-item">
                            <h3>HRランキング</h3>
                            <table class="table table-borderless  table-striped">
                                <tbody>
                                    @foreach($hrColl as $coll)
                                    <tr>
                                        <td class = 'rank'><h5>{{$coll['rank']}}</h5></td>
                                        <td><h5>{{$coll['name']}}</h5></td>
                                        <td><h5 class = 'hr'>{{$coll['hr']}}本</h5></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="carousel-item">
                         <h3>打点ランキング</h3>
                            <table class="table table-borderless  table-striped">
                                <tbody>
                                    @foreach($rbiColl as $coll)
                                    <tr>
                                        <td class = 'rank'><h5>{{$coll['rank']}}</h5></td>
                                        <td><h5>{{$coll['name']}}</h5></td>
                                        <td><h5 class = 'rbi'>{{$coll['rbi']}}打点</h5></td>
                                    </tr>
                                    @endforeach    
                                </tbody>
                            </table>  
                        </div>
                        <a class="carousel-control-prev" href="#example-2" role="button" data-slide="prev">
                          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                          <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#example-2" role="button" data-slide="next">
                          <span class="carousel-control-next-icon" aria-hidden="true"></span>
                          <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>    
        </div>
    </div>
</div>
