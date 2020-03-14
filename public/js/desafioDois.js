$(document).ready(function (){
    $('#btnSalvarUsuario').click(function () {
        if(checaCampos()) return;
        let form = $('#formCadastro').serialize()
        $('#btnSalvarUsuario').attr('disabled', true)
        axios.post('/api/usurio/cadastro', form).then(response => {
            alert('Cadastro efetuado com sucesso!')
            $('#btnSalvarUsuario').attr('disabled', false)
            refresh()
        }).catch( error => {
            alert('Ocorreu um erro na tentativa de cadastro!')
            $('#btnSalvarUsuario').attr('disabled', false)
        })
    })

    function checaCampos()
    {
        if($('#msisdn').val().length === 0 || $('#access_level').val().length === 0 || $('#name').val().length === 0) {
            alert('Preencha todos os campos obrigatórios!')
            return true
        }
        return false
    }

    function refresh() {
        setTimeout(() => {
            window.location.reload()
        }, 500)
    }

    $('.btnusuario').click(function () {
        let idUsuario = $(this).data('idusuario')
        console.log(idUsuario)
        let tipoAcao = $(this).data('acao')
        let url = '/api/usurio/down'
        let texto = 'downgrade'
        if(tipoAcao === 'up') {
            url = '/api/usurio/up'
            texto = 'upgrade'
        }

        axios.put(`${url}/${idUsuario}`).then(response => {
            alert(`${texto} realizada com sucesso!`)
            $('#btnSalvarUsuario').attr('disabled', false)
            //refresh()
        }).catch( error => {
            alert(`Ocorreu um erro na tentativa de ${texto}!`)
            $('#btnSalvarUsuario').attr('disabled', false)
        })
    })
})
