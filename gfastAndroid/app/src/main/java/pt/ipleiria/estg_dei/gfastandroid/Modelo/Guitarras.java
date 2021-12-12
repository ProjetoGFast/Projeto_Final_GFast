package pt.ipleiria.estg_dei.gfastandroid.Modelo;

public class Guitarras {




    private int gui_id, gui_idsubcategoria, gui_idmarca, gui_iva;
    private float gui_preco;
    private String gui_nome, gui_idreferencia, gui_descricao, gui_fotopath, gui_qrcodepath;
    private boolean gui_inativo;

    public Guitarras(int gui_id, int gui_idsubcategoria, int gui_idmarca, int gui_iva, float gui_preco, String gui_nome, String gui_idreferencia, String gui_descricao, String gui_fotopath, String gui_qrcodepath, boolean gui_inativo) {
        this.gui_id = gui_id;
        this.gui_idsubcategoria = gui_idsubcategoria;
        this.gui_idmarca = gui_idmarca;
        this.gui_iva = gui_iva;
        this.gui_preco = gui_preco;
        this.gui_nome = gui_nome;
        this.gui_idreferencia = gui_idreferencia;
        this.gui_descricao = gui_descricao;
        this.gui_fotopath = gui_fotopath;
        this.gui_qrcodepath = gui_qrcodepath;
        this.gui_inativo = gui_inativo;
    }

    public int getGui_id() {
        return gui_id;
    }

    public void setGui_id(int gui_id) {
        this.gui_id = gui_id;
    }

    public int getGui_idsubcategoria() {
        return gui_idsubcategoria;
    }

    public void setGui_idsubcategoria(int gui_idsubcategoria) {
        this.gui_idsubcategoria = gui_idsubcategoria;
    }

    public int getGui_idmarca() {
        return gui_idmarca;
    }

    public void setGui_idmarca(int gui_idmarca) {
        this.gui_idmarca = gui_idmarca;
    }

    public int getGui_iva() {
        return gui_iva;
    }

    public void setGui_iva(int gui_iva) {
        this.gui_iva = gui_iva;
    }

    public float getGui_preco() {
        return gui_preco;
    }

    public void setGui_preco(float gui_preco) {
        this.gui_preco = gui_preco;
    }

    public String getGui_nome() {
        return gui_nome;
    }

    public void setGui_nome(String gui_nome) {
        this.gui_nome = gui_nome;
    }

    public String getGui_idreferencia() {
        return gui_idreferencia;
    }

    public void setGui_idreferencia(String gui_idreferencia) {
        this.gui_idreferencia = gui_idreferencia;
    }

    public String getGui_descricao() {
        return gui_descricao;
    }

    public void setGui_descricao(String gui_descricao) {
        this.gui_descricao = gui_descricao;
    }

    public String getGui_fotopath() {
        return gui_fotopath;
    }

    public void setGui_fotopath(String gui_fotopath) {
        this.gui_fotopath = gui_fotopath;
    }

    public String getGui_qrcodepath() {
        return gui_qrcodepath;
    }

    public void setGui_qrcodepath(String gui_qrcodepath) {
        this.gui_qrcodepath = gui_qrcodepath;
    }

    public boolean isGui_inativo() {
        return gui_inativo;
    }

    public void setGui_inativo(boolean gui_inativo) {
        this.gui_inativo = gui_inativo;
    }
}
