<h5>
    Search result:
</h5>

<div class="col-6">
    <hr>
    <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">Id</th>
            <th scope="col">Name</th>
            <th scope="col">Distance</th>
          </tr>
        </thead>
        <tbody>

            @foreach ($affiliates as $affiliate)
                <tr>
                    <td>{{$affiliate['affiliate_id']}}</td>
                    <td>{{$affiliate['name']}}</td>
                    <td>{{round($affiliate['distance'])}} km</td>
                </tr>
            @endforeach


        </tbody>
      </table>

    <div>
        Total count: {{count($affiliates)}}
    </div>

</div>
