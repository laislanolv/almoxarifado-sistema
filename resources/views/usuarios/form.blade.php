<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Tipo:</strong>
            {!! Form::select('id_tipo', $tipos, isset($usuario) ? $usuario->id_tipo : null, ['placeholder' => 'Selecione o Tipo', 'class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Organização:</strong>
            {!! Form::select('id_organizacao', $organizacoes, isset($usuario) ? $usuario->id_organizacao : null, ['placeholder' => 'Selecione a Organização', 'class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Departamento:</strong>
            {!! Form::select('id_departamento', $departamentos, isset($usuario) ? $usuario->id_departamento : null, ['placeholder' => 'Selecione o Departamento', 'class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Nome:</strong>
            {!! Form::text('nome', isset($usuario) ? $usuario->nome : null, ['placeholder' => 'Nome', 'class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>E-mail:</strong>
            {!! Form::text('email', isset($usuario) ? $usuario->email : null, ['placeholder' => 'E-mail', 'class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Senha:</strong>
            {!! Form::password('senha', ['placeholder' => Route::currentRouteName() == 'usuarios.create' ? 'Senha' : 'Deixe em branco para não atualizar', 'class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Confirmar senha:</strong>
            {!! Form::password('senha_confirmation', ['placeholder' => Route::currentRouteName() == 'usuarios.create' ? 'Confirmar senha' : 'Deixe em branco para não atualizar', 'class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        {!! Form::submit('Enviar', ['class' => 'btn btn-primary']) !!}
    </div>
</div>

@section('scripts')
<script>
    $('#form_usuarios').submit(function() {
        $(this).find('input[type=submit]').prop('disabled', true).attr('value', 'Aguarde...');
    });
</script>
@endsection
