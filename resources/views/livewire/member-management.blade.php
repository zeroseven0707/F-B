<div>
    <table class="table">
        <thead>
            <tr>
                <th>Nama Pelanggan</th>
                <th>Email</th>
                <th>No. HP</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($members as $member)
            <tr>
                <td>{{ $member['namaPelanggan'] }}</td>
                <td>{{ $member['email'] }}</td>
                <td>{{ $member['noHp'] }}</td>
                <td>{{ $member['alamat'] }}</td>
                <td>
                    <form wire:submit.prevent="updateLevel('{{ $member['posPelangganId'] }}')" class="d-flex">
                        <select wire:model="selectedLevels.{{ $member['posPelangganId'] }}" class="shadow" required>
                            <option value="1">Basic</option>
                            <option value="2">Pro</option>
                            <option value="3">Premium</option>
                        </select>
                        <button type="submit" class="border shadow-sm">Update</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            @foreach($pagination['links'] as $link)
            <li class="page-item">
                <a class="page-link" href="{{ $link['url'] }}">{{ $link['label'] }}</a>
            </li>
            @endforeach
        </ul>
    </nav>
</div>
