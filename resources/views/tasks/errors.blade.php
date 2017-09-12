@if (count($errors) > 0)
    <!-- 表单错误清单 -->
    <div class="alert alert-danger">
        <strong>哎呀！出了些问题！</strong>

        <br><br>

        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
