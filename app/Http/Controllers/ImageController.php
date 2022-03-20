<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Ods;
use App\Expertise;
use App\Photo;
use App\Declaration_file;
use App\AuditAction;
use App\Inscription;
use App\Ods_etat;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use RealRashid\SweetAlert\Facades\Alert;



class ImageController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        //  $this->breadcrumb_lis_append(['title' => 'Liste des ODS en instances' , 'url' => 'expertise.liste', 'id' => '' ]);
    }

    public function expImage(Expertise $expertise)
    {
        $expertise = $expertise;

        $ods = ods::find($expertise->id_ods);

        $taille_max  = Inscription::find(4)->nbr;
        $taille_max = $taille_max / 1024;
        $nbr_max     = Inscription::find(3)->nbr;

        $photos = Photo::where('expertise_id', $expertise->id)->get();
        // dd($photos);

        $this->breadcrumb_lis_append(['title' => 'Expertise', 'url' => 'expertise.show', 'id' => $expertise->id]);
        $breadcrumb_lis =  $this->breadcrumb_lis;

        return view('expertise.photo', compact('ods', 'expertise', 'breadcrumb_lis', 'photos', 'taille_max', 'nbr_max'));
    }


    public function expertiseImagePost(Request $request)
    {

        $taille_max  = Inscription::find(4)->nbr;
        $nbr_max     = Inscription::find(3)->nbr;

        $image = $request->file('file');


        $expertise   = Expertise::find($request->id);

        $photos      = Photo::where('expertise_id', $expertise->id)->get()->toArray();

        // if(count($photos) >= $nbr_max){
        //     Alert::warning('Avertissement', 'Vous avez dépasser le nomre limite de photos, le nombre maximum de photos est de '.$nbr_max);
        //     return redirect()->route('expertiseImage',$expertise->id);
        //     // return back()
        //     // ->withErrors('erreur','Vous avez dépasser le nomre limite de photos, le nombre maximum de photos est de '.$nbr_max);
        //    }

        // $this->validate($request, [
        //     'title' => 'required',
        //     'image' => 'required|mimes:jpeg,png,jpg,gif,svg|max:'.$taille_max,
        // ]);

        $destinationPath = storage_path('app/public/files');

        // $file = $request->file('image');
        $file = $image;
        $str = $expertise->id . '-' . Auth::user()->id . '-' . date('Ymd') . time();
        // $crypt = md5($str);
        $filename = $str . '.' . $file->getClientOriginalExtension();
        $image = image::make($file)->resize(1200, null, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath . '/' . $filename);

        $photo = Photo::create([
            'expertise_id' => $expertise->id,
            'titre' =>  $request->title,
            'file' => $filename
        ]);

        // return back()
        //     ->with('success','Téléchargement de l\'image réussi');

        return response()->json(['success' => $filename]);
    }

    public function downloadFile(Photo $photo)
    {
        $photo = $photo;
        return response()->download(storage_path('app/public/files' . '/' . $photo->file));
    }

    public function expertiseImageDelete(Photo $photo)
    {

        $photo = $photo;

        $audit = new AuditAction();
        $audit->audit(auth()->user()->username, 'Suppression Photo', 'suppression photo id: ' . $photo->id);

        $exists = Storage::delete('/public/files/' . $photo->file);
        $photo->delete();

        return back()
            ->with('success', 'Suppression de l\'image réussi');
    }

    public function destroyImage(Request $request)
    {

        $filename = $request->filename;

        $photo = Photo::where('file', $filename)->first();

        $audit = new AuditAction();
        $audit->audit(auth()->user()->username, 'Suppression Photo', 'suppression photo id: ' . $photo->id);

        $exists = Storage::delete('/public/files/' . $photo->file);
        $photo->delete();

        return response()->json(['success' => $filename]);
    }

    public function declaration(Request $request)
    {

        $ods = ods::find($request->id);

        $declarations = Declaration_file::where('ods_id', $ods->id)->get();
        $statu_ods = Ods_etat::where('id_ods', $ods->id)->first();

        if (!$statu_ods) {
            $statu_ods = new Ods_etat();
        }

        return view('expertise.declaration', compact('ods', 'declarations', 'statu_ods'));
    }

    public function downloadFileDeclaration(Declaration_file $declaration)
    {
        $declaration = $declaration;
        return response()->download(storage_path('app/public/declaration_files' . '/' . $declaration->file));
    }

    public function expertiseDeclarationDelete(Declaration_file $declaration)
    {

        $declaration = $declaration;

        $id = $declaration->ods_id;

        $audit = new AuditAction();
        $audit->audit(auth()->user()->username, 'Suppression Declaration', 'suppression declaration id: ' . $declaration->id);

        $exists = Storage::delete('/public/declaration_files/' . $declaration->file);
        $declaration->delete();



        // return back()
        //     ->with('success','Suppression de la declaration réussi');

        // Request()->attributes->add(['id' => $declaration->id]);

        Request()['id'] = $id;

        return $this->declaration(Request());
    }

    public function expertiseDeclarationPost(Request $request)
    {

        $taille_max  = Inscription::find(4)->nbr;
        $ods   = Ods::find($request->id);

        $declaration  = Declaration_file::where('ods_id', $ods->id)->get()->toArray();

        // if(count($declaration) >= 2){
        //     Alert::warning('Avertissement', 'Vous avez dépasser le nomre limite de declaration, une seule déclaration est autorisée');
        //     return redirect()->route('expertise.liste');
        //     // return back()
        //     // ->withErrors('erreur','Vous avez dépasser le nomre limite de photos, le nombre maximum de photos est de '.$nbr_max);
        //    }

        $this->validate($request, [
            'title' => 'required',
            'image' => 'required|mimes:pdf,PDF,jpeg,png,jpg,gif,svg|max:' . $taille_max,
        ]);

        $destinationPath = storage_path('app/public/declaration_files');

        $file = $request->file('image');
        $str = $ods->id . '-' . Auth::user()->id . '-' . date('Ymd') . time();
        // $crypt = md5($str);
        $filename = $str . '.' . $file->getClientOriginalExtension();
        if ($file->getClientOriginalExtension() != 'pdf' && $file->getClientOriginalExtension() != 'PDF') {
            $image = image::make($file)->resize(1200, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $filename);
        } else {
            $file->move($destinationPath, $filename);
        }

        $declaration = Declaration_file::create([
            'ods_id' => $ods->id,
            'description' =>  $request->title,
            'file' => $filename
        ]);

        // return back()
        //     ->with('success','Téléchargement de la déclaration réussi');

        return $this->declaration(Request());
    }
    public function index()
    {
        return view('expertise.index');
    }
    public function zoomMeeting(Request $request)
    {
        // dd($request);

        $client = new \GuzzleHttp\Client();
        $request = $client->request('POST', 'https://demo.adexcloud.dz/api/zoommeeting/1');
        $response = json_decode($request->getBody(), true);
        //dd($response);


        $meetingNum = $response['meeting_id'];
        $signature = $response['signature'];
        $password = $response['password'];

        //send email to client with join url
        $email = "shariti@allianceassurances.com.dz";
        $lien_client = $response['join_url'];
        $information = "Expertise Zoom meeting";
        // $this->envoiMail($email,  $lien_client, $information);



        //   return redirect($response['start_url']);
        //return view('expertise.meeting');

        return view('expertise.meeting-test', compact('meetingNum', 'signature', 'password'));
    }
    /*   public function envoiMail($email, $lien_client, $information)
    {
        if (($email !== '') && ($email !== null)) {

            //   $template_file = "../../../resources/views/layouts/mail_template.php";
            $template_file = '/app/Http/Controllers/mail_template.php';
            $destinataire = $email;

            $swap_var = array(
                "{SITE_ADDR}" => "https://www.heytuts.com",
                "{EMAIL_LOGO}" => "https://www.heytuts.com/images/logo_emailer.png",
                "{EMAIL_TITLE}" => "Send custom HTML emails with a PHP script!",
                "{CUSTOM_URL}" =>  $lien_client,
                "{CUSTOM_IMG}" => "https://i1.wp.com/www.heytuts.com/wp-content/uploads/2019/05/thumbnail_Send-emails-with-php-from-localhost-with-SendMail.png",
                "{TO_NAME}" => "THEIR_NAME",
                "{TO_EMAIL}" => "this_person@their_website.com"
            );

            // Pour les champs $expediteur / $copie / $destinataire, séparer par une virgule s'il y a plusieurs adresses
            $objet = 'Réunion Zoom'; // Objet du message        

            $headers = 'From: Alliance' . "\r\n" .
                'Reply-To: webmaster@allianceassurances.com.dz' . "\r\n" .
                'X-Mailer: PHP/';
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
            //  $message = 'Pour rejoindre la réunion  :' . $lien_client . '\n' . $information;

            if (file_exists($template_file)) {
                $message = file_get_contents($template_file);
            } else {
                die("unable to locate the template file");
            }

            // search and replace for predefined variables, like SITE_ADDR, {NAME}, {lOGO}, {CUSTOM_URL} etc
            foreach (array_keys($swap_var) as $key) {
                if (strlen($key) > 2 && trim($swap_var[$key]) != '')
                    $email_message = str_replace($key, $swap_var[$key], $message);
            }



            $success = mail($destinataire, $objet, $message, $headers);

            if (!$success) {
                $errorMessage = error_get_last();
                echo $errorMessage;
                // echo "Votre message n'a pas pu être envoyé";

            }
        }
    }
*/
    public function envoiMail($email, $lien_client, $information)
    {
        if (($email !== '') && ($email !== null)) {

            //   $template_file = "../../../resources/views/layouts/mail_template_zoom.php";
            $template_file = app_path('/Http/Controllers/mail_template_zoom.php');
            $destinataire = $email;
            $logo_url = public_path('/assets/img/logo_dark.svg');

            //$logo_url = base_path('public/assets/img/logo_dark.svg');			
            //$username = Auth::user()->name;
            //$username2 = Auth::user()->prenom;

            $swap_var = array(
                "{SITE_ADDR}" => "https://allianceassurances.com.dz",
                "{EMAIL_LOGO}" => "https://epaiement.allianceassurances.com.dz/public/assets/img/logo_dark.svg",
                //"{EMAIL_LOGO}" => $logo_url,
                "{EMAIL_TITLE}" => "Rejoindre la réunion ZOOM",
                "{TO_NAME}" => $lien_client,
                //"{TO_EMAIL}" => Auth::user()->email ,
            );

            // Pour les champs $expediteur / $copie / $destinataire, séparer par une virgule s'il y a plusieurs adresses
            $objet = 'Rejoindre la réunion ZOOM'; // Objet du message        

            $headers = 'From: Alliance' . "\r\n" .
                'Reply-To: webmaster@allianceassurances.com.dz' . "\r\n" .
                'X-Mailer: PHP/';
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

            //  $message = 'Votre sinistre à bien été enregistré sous le numéro de police :' . $numero_police . '\n' . $information;

            if (file_exists($template_file)) {
                $email_message = file_get_contents($template_file);
            } else {
                die("unable to locate the template file");
            }

            // search and replace for predefined variables, like SITE_ADDR, {NAME}, {lOGO}, {CUSTOM_URL} etc
            foreach (array_keys($swap_var) as $key) {
                if (strlen($key) > 2 && trim($swap_var[$key]) != '')
                    $email_message = str_replace($key, $swap_var[$key], $email_message);
            }

            $success = mail($destinataire, $objet,  $email_message, $headers);

            if (!$success) {
                $errorMessage = error_get_last();
                echo $errorMessage;
                // echo "Votre message n'a pas pu être envoyé";

            }
        }
    }
}
