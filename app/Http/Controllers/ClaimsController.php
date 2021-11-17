<?php

namespace App\Http\Controllers;

use App\Models\activity;
use App\Models\claims;
use App\Models\diagnosis;
use App\Models\encounter;
use App\Models\observation;
use http\Client\Response;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;
use phpDocumentor\Reflection\DocBlock\Description;
use Spatie\ArrayToXml\ArrayToXml;
use Tymon\JWTAuth\Contracts\Providers\JWT;
use Tymon\JWTAuth\JWTAuth;
use Yajra\DataTables\DataTables;


class ClaimsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    public function index()
    {
        return view('datatables.claims');
    }

    /**
     * @return mixed
     */
    public function getClaimsData()
    {
        $claims = Claims::get();
        return Datatables::of($claims)
            ->addColumn('action', function ($claims) {
                return '<a href="' . route('edit.claim', $claims->id) . '" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
            })
            ->editColumn('id', 'ID: {{$id}}')
            ->make(true);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('claims.form');
    }

    /**
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'MemberID' => 'required|max:255',
            'PayerID' => 'required|max:255',
            'ProviderID' => 'required|max:255',
            'EmiratesIDNumber' => 'required|max:255',
            'Gross' => 'required|max:255',
            'PatientShare' => 'required|max:255',
            'Net' => 'required|max:255',
            'FacilityID' => 'required|max:255',
            'Type' => 'required',
            'PatientID' => 'required',
            'Start' => 'required',
            'End' => 'required',
            'StartType' => 'required',
            'EndType' => 'required',
            'dType' => 'required',
            'dCode' => 'required',
            'aStart' => 'required',
            'aType' => 'required',
            'aCode' => 'required',
            'Quantity' => 'required',
            'aNet' => 'required',
            'Clinician' => 'required',
            'oType' => 'required',
            'oCode' => 'required',
            'Value' => 'required',
            'ValueType' => 'required',
        ]);
        try {
            $data = $this->generateDataArray($request);
            $fileName = 'Claim_'. '_' . $request->PayerID .'_'.microtime(). '.xml';
            $claim = claims::create(
               array_merge(['xmlfile' => $fileName], $data['Claim'])
            );
            if (!empty($claim->id)) {
                $this->generateXML($data, $fileName);
                $encounter = encounter::create(
                    array_merge(['ClaimID' => $claim->id], $data['Encounter'])
                );
                $diagnosis = diagnosis::create(
                    array_merge(['ClaimID' => $claim->id], $data['Diagnosis'])
                );
                $activity = activity::create(
                    array_merge(['ClaimID' => $claim->id], $data['Activity'])
                );
                $observation = observation::create(
                    array_merge(['ClaimID' => $claim->id, 'activityID' => $activity->id], $data['Activity']['Observation'])
                );
            }
            return redirect()->route('claim.listing');
        } catch (\Exception $e) {
            print_r($e->getMessage());exit;
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        if (!empty($id)) {
            $data = claims::with(['encounter', 'diagnosis', 'activity', 'observation'])->where('id', $id)->first();
        }
        return view('claims.form')->with('data', $data);
    }

    /**
     * To update the records is available by id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {

        $validated = $request->validate([
            'MemberID' => 'required|max:255',
            'PayerID' => 'required|max:255',
            'ProviderID' => 'required|max:255',
            'EmiratesIDNumber' => 'required|max:255',
            'Gross' => 'required|max:255',
            'PatientShare' => 'required|max:255',
            'Net' => 'required|max:255',
            'FacilityID' => 'required|max:255',
            'Type' => 'required',
            'PatientID' => 'required',
            'Start' => 'required',
            'End' => 'required',
            'StartType' => 'required',
            'EndType' => 'required',
            'dType' => 'required',
            'dCode' => 'required',
            'aStart' => 'required',
            'aType' => 'required',
            'aCode' => 'required',
            'Quantity' => 'required',
            'aNet' => 'required',
            'Clinician' => 'required',
            'oType' => 'required',
            'oCode' => 'required',
            'Value' => 'required',
            'ValueType' => 'required',
        ]);
        try {
            $claim = claims::with(['encounter', 'diagnosis', 'activity', 'observation'])->find($id);
            if (empty($claim)) {
                throw new \Exception('Claim does not exist.');
            }

            $claim->updated_at = date('Y-m-d H:i:s');
            $data = $this->generateDataArray($request);
            $fileName = 'Claim_'. '_' . $request->PayerID .'_'.microtime(). '.xml';
            $claim->update(array_merge(['xmlfile' => $fileName], $data['Claim']));
            $this->generateXML($data, $fileName);
            $claim->encounter()->update($data['Encounter']);
            $claim->diagnosis()->update($data['Diagnosis']);
            $claim->observation()->update($data['Activity']['Observation']);
            array_pop($data['Activity']);
            $claim->activity()->update($data['Activity']);
            return redirect()->route('claim.listing');
        } catch (\Exception $e) {
            print_r($e->getMessage());exit;
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }

    /**
     * @return mixed
     */
    public function export()
    {
        return Excel::download(new CategoryExport, 'categories.csv', \Maatwebsite\Excel\Excel::CSV);
    }

    /**
     * @param $request
     * @return array[]
     */
    private function generateDataArray($request)
    {

         return array(
            'Header' => array(
                'SenderID' => $request->ProviderID,
                'ReceiverID' => $request->PayerID,
                'TransactionDate' => date('d/m/Y H:i'),
                'RecordCount' => '1',
                'DispositionFlag' => 'PRODUCTION',
            ),
            'Claim' => array(
                'MemberID' => $request->MemberID,
                'PayerID' => $request->PayerID,
                'ProviderID' => $request->ProviderID,
                'EmiratesIDNumber' => $request->EmiratesIDNumber,
                'Gross' => $request->Gross,
                'PatientShare' => $request->PatientShare,
                'Net' => $request->Net,
            ),
            'Encounter' => array(
                'FacilityID' => $request->FacilityID,
                'Type' => $request->Type,
                'PatientID' => $request->PatientID,
                'Start' => date('Y-m-d H:i', strtotime($request->Start)),
                'End' => date('Y-m-d H:i', strtotime($request->End)),
                'StartType' => $request->StartType,
                'EndType' => $request->EndType,
            ),
            'Diagnosis' => array(
                'Type' => $request->dType,
                'Code' => $request->dCode,
            ),
            'Activity' => array(
                'Start' => date('Y-m-d H:i', strtotime($request->aStart)),
                'Type' => $request->aType,
                'Code' => $request->aCode,
                'Quantity' => $request->Quantity,
                'Net' => $request->aNet,
                'Clinician' => $request->Clinician,
                'Observation' => array(
                    'Type' => $request->oType,
                    'Code' => $request->oCode,
                    'Value' => $request->Value,
                    'ValueType' => $request->ValueType,
                )
            ),
        );
    }

    /**
     * @param $data
     * @param $fileName
     * This will save xml file in the storage folder
     */
    private function generateXML($data, $fileName)
    {
        try {
            Storage::disk('local')->put('claims/' . $fileName, ArrayToXml::convert($data, [
                'rootElementName' => 'Claim.Submission',
                '_attributes' => [
                    'xmlns:tns' => 'http://www.eclaimlink.ae/DHD/ValidationSchema',
                    'xmlns:xsi' => 'http://www.w3.org/2001/XMLSchema-instance',
                    'xsi:noNamespaceSchemaLocation' => 'http://www.eclaimlink.ae/DHD/ValidationSchema/ClaimSubmission.xsd',
                ],
            ], true, 'UTF-8'));
        } catch (\Exception $e) {
// will ignore the exception
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|void
     */
    public function retrieveXMLData(Request $request){
        try{


            //Incomplete code only fetching data from xml file and returning json response now validtion and header authentiction.
            if(isset($_FILES['file']) && !empty($_FILES['file'])){
                $xmlString = file_get_contents($_FILES['file']['tmp_name']);
                $xmlObject = simplexml_load_string($xmlString);
                $json = json_encode($xmlObject,JSON_UNESCAPED_SLASHES);
                return response($json,200);
                $phpArray = json_decode($json, true); // if wants to print as array
            }
            return response('Invalid File',422);
        }catch (\Exception $e){
            return response($e->getMessage(),200);
        }

}


}
