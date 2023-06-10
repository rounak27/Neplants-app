<table>
    <thead>
      <tr>
        <th>Name</th>
        <th>Quantity</th>
        <th>Price</th>
      </tr>
    </thead>
    <tbody>
        @foreach($entry->items as $item) 
      <tr>
        <td>{{$item->name }}</td>
        <td>{{$item->quantity }} </td>
        <td>{{$item->price }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
  