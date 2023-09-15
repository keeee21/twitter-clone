<x-header>
    <x-slot name="content">
        
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title">プロフィール</h5>
                            <p class="card-text">名前：{{ $user_detail->name }}</p>
                            <p class="card-text">メールアドレス：{{ $user_detail->email }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-header>