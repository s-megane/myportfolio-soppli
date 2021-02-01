    <div class = 'mb-3'></div>
    <div class = "row justify-content-center">
        <div class = "col-sm-6 col-mb-12">
            <div class = "mt-2">
                <div class ="text-center">
                    <h3>メンバーから見た{{$user->name}}さんの能力評価です</h3>
                    <h4>G(低)～ S(高)</h4>
                    @if($user->targets()->count()===0)
                        <p>{{$user->name}}さんの事をまだ誰も評価していません。</p>
                    @else
                        <p>{{$user->name}}さんの事を{{$user->targets()->count()}}人が評価しています。</p>
                    @endif
                    <table class="table table-bordered">
                        <thead class="text-light bg-secondary">
                            <tr>
                                <th><h3>ミート</h3></th>
                                <th><h3>パワー</h3></th>
                                <th><h3>走　力</h3></th>
                                <th><h3>守備力</h3></th>
                                <th><h3>肩　力</h3></th>
                            </tr>
                        </thead>
                        <tbody class="bg-light fade">
                            <tr>
                                @if($user->targets()->count()!=0)
                                    @foreach($abilitys as $ability)
                                        <td><h2 class = "ability">{{$user->myAbility($user->id , $ability)}}</h2><h6>(評価合計{{$user->Ability($user->id , $ability)}})</h6></td>
                                    @endforeach
                                @endif
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>    
        </div>
    </div>