class VM {
    #container = null;
    #overlay = null;
    #vm = null;

    constructor(){
        this.#newVM();
    }

    #newVM(){
        if (!this.#vmExists()){
            let url_images = `${url_imgs}close.svg`;
            $('body').append(`<article id="container-vm" style="display:none;">
                <section id="overlay-vm">
                    <article id="vm" style="display:none">
                        <div id="vm-cc">
                            <header id="vm-header">
                                <p></p>
                                <img src="${url_images}" class="close-vm" title="Cerrar" onclick="vm.close()">
                            </header>
                            <section id="vm-content">
                            </section>
                        </div>
                    </article>
                </section>
            </article>`);
            this.#initProperties();
        }
    }

    #newLoadScreen(){
        if (!this.#vmExists()){
            let url_images = `${url_imgs}spinner.svg`;
            $('body').append(`<article id="container-vm" style="display:none;">
                <section id="overlay-vm">
                    <img src="${url_images}" style="width:100px;user-select:none"></img>
                </section>
            </article>`);
            this.#initProperties();
        }
    }

    #vmExists(){
        return $(`#container-vm`).length==1;
    }

    #isInit(){
        // return this.#container!=null && this.#overlay!=null && this.#vm!=null;
        return this.#container!=null && this.#overlay!=null;
    }

    #initProperties(){
        this.#container = $(`#container-vm`).length==1? $(`#container-vm`) : null;
        this.#overlay = this.#container!=null? $(this.#container).find(`#overlay-vm`) : null;
        this.#vm = this.#overlay!=null? $(this.#overlay).find(`#vm`) : null;
    }

    open(url,title='',data={},callback_onLoad=null,callback_onClose=null){
        if (this.#isInit()){
            this.#newVM();
            $(this.#overlay).on('click',()=>{
                if ($(this.#overlay)[0] == event.target)
                    this.close(callback_onClose);
            });
            $(this.#container).fadeIn(()=>{
                $(this.#vm).fadeIn(100,()=>{
                    $(`#vm-cc`).find(`header`).find(`p`).text(title);
                    $(`#vm-content`).empty();
                    $(`#vm-content`).load(url,data,callback_onLoad);
                });
            });
        }else{console.error('VM no inicializada');}
    }

    close(callback=null){
        if (this.#isInit()){
            $(this.#container).fadeOut(()=>{
                // $(this.#vm).hide(()=>{
                    $(this.#container).remove();
                    if (callback!=null)
                        callback();
                // });
                
            });
        }else{console.error('VM no inicializada');}
    }

    confirm(text=''){
        if (this.#isInit()){
            this.#newVM();
            $(this.#overlay).on('click',(event)=>{
                if ($(this.#overlay)[0] == event.target)
                    this.close();
            });
            $(this.#container).fadeIn(()=>{
                $(this.#vm).addClass('small');
                $(this.#vm).fadeIn(100,()=>{
                    $(`#vm-content`).append(`
                        <div style="display:flex;flex-direction:column;justify-content:start;align-items:center;row-gap:2rem;">
                            <div><p style="text-align:center">${text}</p></div>
                            <div style="display:flex;justify-content:center;column-gap:2rem;">
                                <div class="btn btn-c-check">ACEPTAR</div>
                                <div class="btn btn-c-close" onclick="vm.close()">CANCELAR</div>
                            </div>
                        </div>
                    `);
                });
            });
        }else{console.error('VM no inicializada');}
    }

    error(text=''){
        if (this.#isInit()){
            this.#newVM();
            $(this.#overlay).on('click',(event)=>{
                if ($(this.#overlay)[0] == event.target)
                    this.close();
            });
            $(this.#container).fadeIn(()=>{
                $(this.#vm).addClass('small');
                $(this.#vm).fadeIn(100,()=>{
                    $(`#vm-content`).append(`
                        <div style="width:100%;display:flex;flex-direction:column;justify-content:start;align-items:center;row-gap:1rem;">
                            <img class="error-icon"></img>
                            <p style="text-align:center">${text}</p>
                        </div>
                    `);
                    console.log('error');
                    setTimeout(()=>this.close(),2500);
                });
            });
        }else{console.error('VM no inicializada');}
    }

    info(text=''){
        if (this.#isInit()){
            this.#newVM();
            $(this.#overlay).on('click',(event)=>{
                if ($(this.#overlay)[0] == event.target)
                    this.close();
            });
            $(this.#container).fadeIn(()=>{
                $(this.#vm).addClass('small');
                $(this.#vm).fadeIn(100,()=>{
                    $(`#vm-content`).append(`
                        <div style="width:100%;display:flex;flex-direction:column;justify-content:start;align-items:center;row-gap:1rem;overflow:auto; word-wrap:break-all;">
                            <img class="info-icon"></img>
                            <p style="text-align:center;white-space:normal;">${text}</p>
                        </div>
                    `);
                    setTimeout(()=>this.close(),2500);
                });
            });
        }else{console.error('VM no inicializada');}
    }

    loading(enabled=true, callback=null){
        if (this.#isInit()){
            if (enabled){
                this.close(()=>{
                    this.#newLoadScreen();
                    $(this.#container).fadeIn(100,function(){
                        if (callback!=null)
                            callback();
                    });
                });
            }else{
                this.close(callback);
            }
        }else{console.error('VM no inicializada');}
    }
}