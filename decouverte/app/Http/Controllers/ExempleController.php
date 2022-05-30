<?php

namespace App\Http\Controllers;

// Grâce à la CLI, l'objet Request à été automatiquement importé.
use App\Models\Plat;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class ExempleController extends Controller
{
    //////////////////////////////// TEST ///////////////////////////////////////
    public function test()
    {
//        $plat1 = 'Salade César';
//        $plat2 = 'Poulet Maffé';

        ///////////////////// Les diffentes façons de return /////////////////

        # La fonction native PHP compact() permet de compacter les paires $key => $value.
//        return view('view', compact("plat1",'plat2') );

        # La méthode with() permet de passer un argument à la vue, à l'exception que vous devrez chainer cette méthode pour passer plusieurs params
//        return view('view')->with('plat1', $plat1)->with('plat2', $plat2);

        // On déclare un tableau
        $plats = ['Salade César', 'Poulet Maffé'];

        return view('view', [
            'plats' => $plats
        ]);
    }


//////////////////////////////////////////// PARTIE DEUX - ROUTING ////////////////////////////////////////////
    public function home()
    {
//        $plats = ['Salade César', 'Poulet Maffé'];

        # Appel static pour récupérer tous les models Plat dans la BDD.
//        $plats = Plat::all();

        # Si vous souhaitez ordonné vos résultats selon une direction ('ASC' ou 'DESC'), la méthode orderBy() vous sera utile
        $plats = Plat::orderBy('title')->get();

        return view('home', [
           'plats' => $plats
        ]);
    }
//////////////////////////////////////////////////////////////
    public function contact()
    {
        return view('contact');
    }
/////////////////////////////////////////////////////////////////
    public function show($id)
    {
//        $plats = [
//          1 =>  'Salade César',
//          2 =>  'Poulet Maffé'
//        ];

        /* Condition ternaire '??' (opérateur de coalescence NULL) qui va tester à gauche de l'opérateur '??' => isset()
                 => l'opérateur '?:' teste avec un empty()

         Cela équivaut à écrire un if/else de la sorte :
                 if (isset($plats[$id])
                {
                    $plat = $plats[$id];
                }
                else
                {
                    $plat = Ce plat n'existe pas !";
                }

        => REFACTO en ternaire = $plat = isset($plats[$id]) ? $plats[$id] : "Ce plat n'existe pas !";
          */

//        $plat = $plats[$id] ?? "Ce plat n'existe pas !";
//////////////////////////////////////////////////////////////////////////////////

        # Grâce à notre model Plat, on peut requêter dessus avec la méthode find() et l'argument $id
//        $plat = Plat::find($id);

        $plat = Plat::findOrFail($id);

        return view('show', [
            'plat' => $plat
        ]);
    }
//////////////////////////////////////////////////////////////
    public function create()
    {
        return view('form_plat', [
            'plat' => new Plat()
        ]);
    }
//////////////////////////////////////////////////////////////


    /**
     * La fonction 'store' est utilisé par Laravel pour traiter les formulaires.
     *      On injecte la dépendance de l'objet Request.
     *      Cela nous permet de récupérer les données du formulaire.
     */
    public function store(Request $request)
    {
        ///////////////////////////////////////////////////////////////
        /*
            Nous avons une erreur 419 | Page Expired => c'est une erreur normale, un mal pour un bien.
            Laravel nous rappelle qu'il a besoin d'un TOKEN CSRF dans le formulaire
                    => dans la vue blade concernée, on ajoute la directive Blade @csrf
            En sécurité web, la faille CSRF est critique. CSRF = Cross Site Request Forgery
                    => (parfois prononcé sea-surf en anglais) ou écrit parfois XSRF.
            La faille CSRF est un type de vulnérabilité des systèmes d'authentification web.
            L'attaque étant actionnée par l'utilisateur, un grand nombre de systèmes d'authentification web sont contourné.
        */
        ///////////////////////////REFACTORISATION//////////////////////////////////////

        # Methode qui nécessite d'ajouter les props de Plat à $fillable(dans le Model Plat)
        Plat::create([
            'title' => $request->input('title'),
            'content' => $request->input('content')
        ]);

        return redirect('/');
        //////////////////////////////////////////////////////////////

        # Instanciation d'un objet
        $plat = new Plat();

        # On vient "hydrater" les propriétés de notre nouvelle instance de PLat avec les données du formulaire
        $plat->title = $request->input('title');
        $plat->content = $request->input('content');

        // Exemple de différence entre un ORM de type Data Mapper (ex: Doctrine) et Active Record (ex : Eloquent) :
            # Data Mapper :     $plat->title = $request->input('title');
                                #$plat->content = $request->input('content');
                                # $entityManager->save('$plat')

            # Active Record :     $plat->title = $request->input('title');
                                # $plat->content = $request->input('content');
                                # $plat->save()

        $plat->save();


    }

    public function update($id)
    {
        return view('form_plat', [
            'plat' => Plat::findOrFail($id)
        ]);
    }



    public function storeUpdate($id, Request $request)
    {
        $plat = Plat::findOrFail($id);


        $plat->update([
            'title' => $request->input('title'),
            'content' => $request->input('content')
        ]);

        dd($plat);

        //Session::flash('message', 'Vous avez modifié le plat $plat->title');

        return redirect('/');
    }

    public function delete($id)
    {

        $plat = Plat::findOrFail($id);

        $plat->delete();

        # On redirige les utilisateurs grace à l'objet Response et sa methode redirectToRoute
        #  => On renseigne le nom d'une route (et plus sonr url: voir ci-dessous le return redirect('/')))
        return Response::redirectToRoute('home');
    }
}
