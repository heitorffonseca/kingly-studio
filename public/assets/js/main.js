const createApp = () => {
    return {
        vars: {
            windowWidth: $(window).width(),
            mobile: ( $(window).width() > 768 )
        },

        masks(){
            if( $('#cep').length > 0 ) $('#cep').mask('00000-000');

            if( $('#cpf').length > 0 ) $('#cpf').mask('000.000.000-00');
        },

        features(){},

        store: function () {
            const newForm = document.getElementById('newForm');
            const file = document.getElementById('file');
            const send = document.getElementById('send');

            if (newForm)
                newForm.addEventListener('click', event => {
                    $('.overlay').addClass('active');

                    $('html, body').stop().animate({
                        scrollTop: $('.overlay').offset().top
                    }, 500);
                });

            if (file)
                file.addEventListener('change', event => {
                    if ($('.overlay').length > 0) $('.overlay .check').show();
                });

            if (send)
                send.addEventListener('click', async event => {
                    event.preventDefault();

                    const image = document.getElementById('file');

                    if (image.files.length == 0) {
                        alert('Necessário inserir uma nota fiscal');
                        return false;
                    }

                    const extensions = ['jpeg', 'jpg', 'png']

                    const ext = image.files[0].type.split('/')[1].toLowerCase();

                    console.log(ext);

                    if (extensions.indexOf(ext) == -1) {
                        alert('Necessário inserir uma imagem com um extensão válida. ["jpg", "jpeg" ou "png]');
                        return false;
                    }

                    const required = ['name', 'email', 'cpf', 'cep', 'number'];

                    const form = $('#form');
                    const elements = form.serializeArray();


                    const itemsNotValidated = await elements.filter(item => {
                        if (required.indexOf(item.name) > -1 && item.value == "") return item;
                    });

                    if (itemsNotValidated.length > 0) {
                        alert('Necessário preencher todos os campos obrigatórios');
                        return false;
                    }

                    if (!document.getElementById('terms').checked) {
                        alert('Necessário concordar com o regulamento');
                        return false;
                    }

                    form.submit();
                });
        },

        autoCompleteCep(){

            const cep = document.getElementById('cep');

            if (cep)
                cep.addEventListener('change', async event => {
                try {
                    $('#spin').show();

                    let search = cep.value.replace(/[^0-9]/g,'');

                    if (! /^[0-9]{8}$/.test(search)) return false;

                    const response = await fetch(`https://viacep.com.br/ws/${search}/json/`, {
                        method: 'GET',
                        mode: 'cors',
                        cache: 'default'
                    });

                    let data = await response.json();

                    data = {
                        cep: data.cep,
                        street: data.logradouro,
                        neighborhood: data.bairro,
                        city: data.localidade,
                        state: data.uf,
                    }

                    for(const field in data){

                        let element = document.getElementById(field);
                        if (element) element.value = data[field];

                    }

                    $('#spin').hide();

                } catch (error){

                    console.error(error);

                }
            });

        },

        start(){
            this.masks();
            this.features();
            this.store();
            this.autoCompleteCep();
        }
    }
}

createApp().start();


