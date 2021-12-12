package pt.ipleiria.estg_dei.gfastandroid.Modelo;

public class Livro {

    private int id, ano;
    private String titulo, serie, autor, capa;
   // private static int autoIncrement = 1;

    public Livro(int id, int ano, String capa, String titulo, String serie, String autor) {
        this.id = id;
        this.ano = ano;
        this.capa = capa;
        this.titulo = titulo;
        this.serie = serie;
        this.autor = autor;
    }

    public int getId() {
        return id;
    }


    public int getAno() {
        return ano;
    }

    public void setAno(int ano) {
        this.ano = ano;
    }

    public String getCapa() {
        return capa;
    }

    public void setCapa(String capa) {
        this.capa = capa;
    }

    public String getTitulo() {
        return titulo;
    }

    public void setTitulo(String titulo) {
        this.titulo = titulo;
    }

    public String getSerie() {
        return serie;
    }

    public void setSerie(String serie) {
        this.serie = serie;
    }

    public void setId(int id) { this.id = id; }

    public String getAutor() {
        return autor;
    }

    public void setAutor(String autor) {
        this.autor = autor;
    }
}
