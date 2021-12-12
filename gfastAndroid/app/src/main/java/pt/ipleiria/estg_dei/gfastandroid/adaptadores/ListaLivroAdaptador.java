package pt.ipleiria.estg_dei.gfastandroid.adaptadores;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.ImageView;
import android.widget.TextView;

import com.bumptech.glide.Glide;
import com.bumptech.glide.load.engine.DiskCacheStrategy;

import java.util.ArrayList;

import pt.ipleiria.estg_dei.gfastandroid.Modelo.Livro;
import pt.ipleiria.estg_dei.gfastandroid.R;

public class ListaLivroAdaptador extends BaseAdapter {


    private Context context;
    private LayoutInflater inflater;
    private ArrayList<Livro> livros;

    public ListaLivroAdaptador(Context context, ArrayList<Livro> livros) {
        this.context = context;
        this.livros = livros;
    }

    @Override
    public int getCount() {
        return livros.size();
    }

    @Override
    public Object getItem(int i) {
        return livros.get(i);
    }

    @Override
    public long getItemId(int i) {
        return livros.get(i).getId();
    }

    @Override
    public View getView(int i, View view, ViewGroup viewGroup) {

        if(inflater == null){
            inflater = (LayoutInflater) context.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
        }

        if(view == null)
        {
            view = inflater.inflate(R.layout.item_lista_livro, null);
        }





        ViewHolderLista viewHolderLista = (ViewHolderLista) view.getTag();
        if(viewHolderLista == null)
        {
            viewHolderLista = new ViewHolderLista(view);
            view.setTag(viewHolderLista);
        }
        viewHolderLista.update(livros.get(i));

        return view;
    }

    private class ViewHolderLista{
        private TextView tvTitulo,tvSerie, tvAno, tvAutor;
        private ImageView imgCapa;

        public ViewHolderLista(View view){
            tvTitulo = view.findViewById(R.id.tvTituloDinamico);
            tvSerie = view.findViewById(R.id.tvSerieDinamico);
            tvAno = view.findViewById(R.id.tvAnoDinamico);
            tvAutor = view.findViewById(R.id.tvAutorDinamico);
            imgCapa = view.findViewById(R.id.imgCapa);
        }

        public void update(Livro livro){

            System.out.println("teste" + livro.getCapa());
            tvTitulo.setText(livro.getTitulo());
            tvSerie.setText(livro.getSerie());
            tvAutor.setText(livro.getAutor());
            tvAno.setText(""+livro.getAno());
            Glide.with(context)
                    .load(livro.getCapa())
                    .placeholder(R.drawable.logoipl)
                    .diskCacheStrategy(DiskCacheStrategy.ALL)
                    .into(imgCapa);
           // imgCapa.setImageResource(livro.getCapa());
        }
    }
}
