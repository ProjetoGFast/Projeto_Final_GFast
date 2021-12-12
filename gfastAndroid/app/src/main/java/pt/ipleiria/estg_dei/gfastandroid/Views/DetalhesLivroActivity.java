package pt.ipleiria.estg_dei.gfastandroid.Views;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AlertDialog;
import androidx.appcompat.app.AppCompatActivity;

import android.content.DialogInterface;
import android.content.Intent;
import android.os.Bundle;
import android.view.Menu;
import android.view.MenuInflater;
import android.view.MenuItem;
import android.view.View;
import android.widget.EditText;
import android.widget.ImageView;

import com.bumptech.glide.Glide;
import com.bumptech.glide.load.engine.DiskCacheStrategy;
import com.google.android.material.floatingactionbutton.FloatingActionButton;

import pt.ipleiria.estg_dei.gfastandroid.Listeners.LivroListener;
import pt.ipleiria.estg_dei.gfastandroid.MenuMainActivity;
import pt.ipleiria.estg_dei.gfastandroid.Modelo.Livro;
import pt.ipleiria.estg_dei.gfastandroid.Modelo.SingletonGestorLivros;
import pt.ipleiria.estg_dei.gfastandroid.R;

public class DetalhesLivroActivity extends AppCompatActivity implements LivroListener {

    public static final String ID_LIVRO = "IDLIVRO";
    private Livro livro;

    private EditText etTitulo, etSerie, etAno, etAutor;
    private ImageView imgCapa;
    private FloatingActionButton floatingActionButton;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_detalhes_livro);


        int id = getIntent().getIntExtra(ID_LIVRO, 0);
        System.out.println("----"+id);

        livro = SingletonGestorLivros.getInstance(getApplicationContext()).getLivroBD(id);

        etTitulo = findViewById(R.id.etTitulo);
        etSerie = findViewById(R.id.etSerie);
        etAno = findViewById(R.id.etAno);
        etAutor = findViewById(R.id.etAutor);
        imgCapa = findViewById(R.id.imgCapaDetalhes);
        floatingActionButton = findViewById(R.id.fabGuardar);
        //Ação de Editar
        if(livro != null)
        {

            carregarLivro();
            floatingActionButton.setImageResource(R.drawable.ic_menu_guardar);

        }else
        {
            setTitle("Adicionar Livros");
            floatingActionButton.setImageResource(R.drawable.ic_menu_adicionar);
        }

        floatingActionButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                if(livro != null) {
                    if (isLivroValido() == true) {
                        livro.setTitulo(etTitulo.getText().toString());
                        livro.setSerie(etSerie.getText().toString());
                        livro.setAutor(etAutor.getText().toString());
                        livro.setAno(Integer.parseInt(etAno.getText().toString()));

                        SingletonGestorLivros.getInstance(getApplicationContext()).editarLivroAPI(livro, getApplicationContext());

                    }
                }else if(isLivroValido() == true){
                        livro = new Livro(0 ,Integer.parseInt(etAno.getText().toString()),
                                "http://amsi.dei.estg.ipleiria.pt/img/livros/androidstudio.jpg",etTitulo.getText().toString(),
                                etSerie.getText().toString(), etAutor.getText().toString());

                       SingletonGestorLivros.getInstance(getApplicationContext()).adicionarLivroAPI(livro, getApplicationContext());
                       finish();
                    }

            }
        });

        SingletonGestorLivros.getInstance(getApplicationContext()).setLivroListener(this);
    }

    private void carregarLivro(){

        setTitle("Detalhes:" + livro.getTitulo());
        etTitulo.setText(livro.getTitulo());
        etSerie.setText(livro.getSerie());
        etAutor.setText(livro.getAutor());
        etAno.setText("" + livro.getAno());

        Glide.with(getApplicationContext())
                .load(livro.getCapa())
                .placeholder(R.drawable.logoipl)
                .diskCacheStrategy(DiskCacheStrategy.ALL)
                .into(imgCapa);

    }
    private boolean isLivroValido(){
        String title = etTitulo.getText().toString();
        String serie = etSerie.getText().toString();
        String autor = etAutor.getText().toString();
        String ano = etAno.getText().toString();
        //<Livro>
        if(title.length() < 4)
        {
            etTitulo.setError("Titulo Inválido");
            return false;
        }
        if(serie.length() < 4)
        {
            etSerie.setError("Serie Inválido");
            return false;
        }
        if(autor.length() < 4)
        {
            etAutor.setError("Autor Inválido");
            return false;
        }
        if(ano.length() < 4)
        {
            etAno.setError("Ano Inválido");
            return false;
        }
        return true;

    }





    @Override
    public boolean onCreateOptionsMenu(Menu menu)
    {
        MenuInflater menuInflater = getMenuInflater();
        menuInflater.inflate(R.menu.menu_detalhes_livro, menu);
        return super.onCreateOptionsMenu(menu);
    }

    @Override
    public boolean onOptionsItemSelected(@NonNull MenuItem item) {
        switch (item.getItemId())
        {
            case R.id.itemRemover:
                dialogRemover();
                return true;
        }
        return super.onOptionsItemSelected(item);
    }

    private void dialogRemover(){
        AlertDialog.Builder builder = new AlertDialog.Builder(this);
        builder.setTitle("Remover Livro").setMessage("Pretende mesmo remover?")
                .setPositiveButton(android.R.string.yes, new DialogInterface.OnClickListener() {
            @Override
            public void onClick(DialogInterface dialogInterface, int i) {
                SingletonGestorLivros.getInstance(getApplicationContext()).removerLivroAPI(livro,getApplicationContext());
                Intent intent = new Intent();
                intent.putExtra(MenuMainActivity.OP_CODE, MenuMainActivity.DEL_REQCOD);
                setResult(RESULT_OK, intent);
                finish();
            }
        })
                .setNegativeButton(android.R.string.no, new DialogInterface.OnClickListener() {
                    @Override
                    public void onClick(DialogInterface dialogInterface, int i) {

                    }
                }).setIcon(android.R.drawable.ic_delete)
                .show();

    }

    @Override
    public void onRefreshDetalhes(int op) {
        Intent intent = new Intent();
        intent.putExtra(MenuMainActivity.OP_CODE, op);
        setResult(RESULT_OK, intent);
        finish();
    }
}