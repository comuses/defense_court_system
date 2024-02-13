<?php

return [
    'common' => [
        'actions' => 'Actions',
        'create' => 'Create',
        'edit' => 'Edit',
        'update' => 'Update',
        'new' => 'New',
        'cancel' => 'Cancel',
        'attach' => 'Attach',
        'detach' => 'Detach',
        'save' => 'Save',
        'delete' => 'Delete',
        'delete_selected' => 'Delete selected',
        'search' => 'Search...',
        'back' => 'Back to Index',
        'are_you_sure' => 'Are you sure?',
        'no_items_found' => 'No items found',
        'created' => 'Successfully created',
        'saved' => 'Saved successfully',
        'removed' => 'Successfully removed',
    ],

    'registrars' => [
        'name' => 'Registrars',
        'index_title' => 'Registrars List',
        'new_title' => 'New Registrar',
        'create_title' => 'Create Registrar',
        'edit_title' => 'Edit Registrar',
        'show_title' => 'Show Registrar',
        'inputs' => [
            'MIDNumber' => 'Mid Number',
            'Rank' => 'Rank',
            'Name' => 'Name',
            'fieldType' => 'Field Type',
            'address' => 'Address',
            'city' => 'City',
            'state' => 'State',
            'court_id' => 'Court',
        ],
    ],

    'users' => [
        'name' => 'Users',
        'index_title' => 'Users List',
        'new_title' => 'New User',
        'create_title' => 'Create User',
        'edit_title' => 'Edit User',
        'show_title' => 'Show User',
        'inputs' => [
            'name' => 'Name',
            'email' => 'Email',
            'password' => 'Password',
            'description' => 'Description',
            'registrar_id' => 'Registrar',
        ],
    ],

    'courts' => [
        'name' => 'Courts',
        'index_title' => 'Courts List',
        'new_title' => 'New Court',
        'create_title' => 'Create Court',
        'edit_title' => 'Edit Court',
        'show_title' => 'Show Court',
        'inputs' => [
            'courtID' => 'Court Id',
            'name' => 'Name',
            'courtType' => 'Court Type',
            'Speciality' => 'Speciality',
            'Descryption' => 'Descryption',
        ],
    ],

    'attorneys' => [
        'name' => 'Attorneys',
        'index_title' => 'Attorneys List',
        'new_title' => 'New Attorney',
        'create_title' => 'Create Attorney',
        'edit_title' => 'Edit Attorney',
        'show_title' => 'Show Attorney',
        'inputs' => [
            'attoneyID' => 'Attoney Id',
            'court_id' => 'Court',
            'fullname' => 'Fullname',
            'courtType' => 'Court Type',
            'address' => 'Address',
            'state' => 'State',
            'empType' => 'Emp Type',
            'description' => 'Description',
        ],
    ],

    'judges' => [
        'name' => 'Judges',
        'index_title' => 'Judges List',
        'new_title' => 'New Judge',
        'create_title' => 'Create Judge',
        'edit_title' => 'Edit Judge',
        'show_title' => 'Show Judge',
        'inputs' => [
            'court_id' => 'Court',
            'judgeID' => 'Judge Id',
            'name' => 'Name',
            'courtType' => 'Court Type',
            'address' => 'Address',
            'state' => 'State',
            'empType' => 'Emp Type',
            'description' => 'Description',
        ],
    ],

    'bars' => [
        'name' => 'Bars',
        'index_title' => 'Bars List',
        'new_title' => 'New Bar',
        'create_title' => 'Create Bar',
        'edit_title' => 'Edit Bar',
        'show_title' => 'Show Bar',
        'inputs' => [
            'court_id' => 'Court',
            'address' => 'Address',
            'state' => 'State',
            'location' => 'Location',
            'description' => 'Description',
        ],
    ],

    'mods' => [
        'name' => 'Mods',
        'index_title' => 'Mods List',
        'new_title' => 'New Mod',
        'create_title' => 'Create Mod',
        'edit_title' => 'Edit Mod',
        'show_title' => 'Show Mod',
        'inputs' => [
            'modID' => 'Mod Id',
            'name' => 'Name',
            'address' => 'Address',
            'state' => 'State',
            'description' => 'Description',
        ],
    ],

    'case_charges' => [
        'name' => 'Case Charges',
        'index_title' => 'CaseCharges List',
        'new_title' => 'New Case charge',
        'create_title' => 'Create CaseCharge',
        'edit_title' => 'Edit CaseCharge',
        'show_title' => 'Show CaseCharge',
        'inputs' => [
            'mod_employee_id' => 'Mod Employee',
            'mod_id' => 'Mod',
            'rank' => 'Rank',
            'fullName' => 'Full Name',
            'address' => 'Address',
            'state' => 'State',
            'crimeType' => 'Crime Type',
            'crimeDate' => 'Crime Date',
            'chargeDate' => 'Charge Date',
            'registrar_id' => 'Registrar',
        ],
    ],

    'mod_employees' => [
        'name' => 'Mod Employees',
        'index_title' => 'ModEmployees List',
        'new_title' => 'New Mod employee',
        'create_title' => 'Create ModEmployee',
        'edit_title' => 'Edit ModEmployee',
        'show_title' => 'Show ModEmployee',
        'inputs' => [
            'mod_id' => 'Mod',
            'EmpID' => 'Emp Id',
            'rank' => 'Rank',
            'fullName' => 'Full Name',
            'address' => 'Address',
            'state' => 'State',
            'empType' => 'Emp Type',
        ],
    ],

    'case_hearings' => [
        'name' => 'Case Hearings',
        'index_title' => 'CaseHearings List',
        'new_title' => 'New Case hearing',
        'create_title' => 'Create CaseHearing',
        'edit_title' => 'Edit CaseHearing',
        'show_title' => 'Show CaseHearing',
        'inputs' => [
            'court_id' => 'Court',
            'mod_id' => 'Mod',
            'attorney_id' => 'Attorney',
            'judge_id' => 'Judge',
            'witness_id' => 'Witness',
            'casehearingID' => 'Casehearing Id',
            'chilotname' => 'Chilotname',
            'fileNumber' => 'File Number',
            'caseStartDate' => 'Case Start Date',
            'address' => 'Address',
            'state' => 'State',
            'location' => 'Location',
            'description' => 'Description',
            'attoneryWitnessID' => 'Attonery Witness Id',
            'accEmpID' => 'Acc Emp Id',
        ],
    ],

    'witnesses' => [
        'name' => 'Witnesses',
        'index_title' => 'Witnesses List',
        'new_title' => 'New Witness',
        'create_title' => 'Create Witness',
        'edit_title' => 'Edit Witness',
        'show_title' => 'Show Witness',
        'inputs' => [
            'witnessID' => 'Witness Id',
            'name' => 'Name',
            'address' => 'Address',
            'state' => 'State',
            'attorneyWitness' => 'Attorney Witness',
            'Description' => 'Description',
            'accusedWitness' => 'Accused Witness',
            'attoneyID' => 'Attoney Id',
            'caseChargedID' => 'Case Charged Id',
        ],
    ],

    'appointments' => [
        'name' => 'Appointments',
        'index_title' => 'Appointments List',
        'new_title' => 'New Appointment',
        'create_title' => 'Create Appointment',
        'edit_title' => 'Edit Appointment',
        'show_title' => 'Show Appointment',
        'inputs' => [
            'mod_id' => 'Mod',
            'case_hearing_id' => 'Case Hearing',
            'empID' => 'Emp Id',
            'fullname' => 'Fullname',
            'chargeType' => 'Charge Type',
            'appointmentDate' => 'Appointment Date',
            'description' => 'Description',
        ],
    ],

    'decisions' => [
        'name' => 'Decisions',
        'index_title' => 'Decisions List',
        'new_title' => 'New Decision',
        'create_title' => 'Create Decision',
        'edit_title' => 'Edit Decision',
        'show_title' => 'Show Decision',
        'inputs' => [
            'mod_id' => 'Mod',
            'case_hearing_id' => 'Case Hearing',
            'empID' => 'Emp Id',
            'name' => 'Name',
            'chargeType' => 'Charge Type',
            'caseStartDate' => 'Case Start Date',
            'decisionDate' => 'Decision Date',
            'decisionType' => 'Decision Type',
            'description' => 'Description',
        ],
    ],

    'court_attorneys' => [
        'name' => 'Court Attorneys',
        'index_title' => 'Attorneys List',
        'new_title' => 'New Attorney',
        'create_title' => 'Create Attorney',
        'edit_title' => 'Edit Attorney',
        'show_title' => 'Show Attorney',
        'inputs' => [
            'courtID' => 'Court Id',
            'attoneyID' => 'Attoney Id',
            'fullname' => 'Fullname',
            'courtType' => 'Court Type',
            'address' => 'Address',
            'state' => 'State',
            'empType' => 'Emp Type',
            'description' => 'Description',
        ],
    ],

    'court_judges' => [
        'name' => 'Court Judges',
        'index_title' => 'Judges List',
        'new_title' => 'New Judge',
        'create_title' => 'Create Judge',
        'edit_title' => 'Edit Judge',
        'show_title' => 'Show Judge',
        'inputs' => [
            'CourtID' => 'Court Id',
            'judgeID' => 'Judge Id',
            'name' => 'Name',
            'courtType' => 'Court Type',
            'address' => 'Address',
            'state' => 'State',
            'empType' => 'Emp Type',
            'description' => 'Description',
        ],
    ],

    'court_bars' => [
        'name' => 'Court Bars',
        'index_title' => 'Bars List',
        'new_title' => 'New Bar',
        'create_title' => 'Create Bar',
        'edit_title' => 'Edit Bar',
        'show_title' => 'Show Bar',
        'inputs' => [
            'courtID' => 'Court Id',
            'address' => 'Address',
            'state' => 'State',
            'location' => 'Location',
            'description' => 'Description',
        ],
    ],

    'court_case_hearings' => [
        'name' => 'Court Case Hearings',
        'index_title' => 'CaseHearings List',
        'new_title' => 'New Case hearing',
        'create_title' => 'Create CaseHearing',
        'edit_title' => 'Edit CaseHearing',
        'show_title' => 'Show CaseHearing',
        'inputs' => [
            'casehearingID' => 'Casehearing Id',
            'modID' => 'Mod Id',
            'courtID' => 'Court Id',
            'judgeID' => 'Judge Id',
            'attorneyID' => 'Attorney Id',
            'attoneryWitnessID' => 'Attonery Witness Id',
            'accusedWitnessID' => 'Accused Witness Id',
            'chilotname' => 'Chilotname',
            'accEmpID' => 'Acc Emp Id',
            'fileNumber' => 'File Number',
            'caseStartDate' => 'Case Start Date',
            'address' => 'Address',
            'state' => 'State',
            'location' => 'Location',
            'description' => 'Description',
            'attorney_id' => 'Attorney',
            'mod_id' => 'Mod',
            'judge_id' => 'Judge',
            'witness_id' => 'Witness',
        ],
    ],

    'registrar_case_charges' => [
        'name' => 'Registrar Case Charges',
        'index_title' => 'CaseCharges List',
        'new_title' => 'New Case charge',
        'create_title' => 'Create CaseCharge',
        'edit_title' => 'Edit CaseCharge',
        'show_title' => 'Show CaseCharge',
        'inputs' => [
            'modID' => 'Mod Id',
            'MIDnumber' => 'Mi Dnumber',
            'rank' => 'Rank',
            'fullName' => 'Full Name',
            'address' => 'Address',
            'state' => 'State',
            'crimeType' => 'Crime Type',
            'crimeDate' => 'Crime Date',
            'chargeDate' => 'Charge Date',
            'mod_id' => 'Mod',
            'mod_employee_id' => 'Mod Employee',
        ],
    ],

    'mod_employee_case_charges' => [
        'name' => 'ModEmployee Case Charges',
        'index_title' => 'CaseCharges List',
        'new_title' => 'New Case charge',
        'create_title' => 'Create CaseCharge',
        'edit_title' => 'Edit CaseCharge',
        'show_title' => 'Show CaseCharge',
        'inputs' => [
            'modID' => 'Mod Id',
            'MIDnumber' => 'Mi Dnumber',
            'rank' => 'Rank',
            'fullName' => 'Full Name',
            'address' => 'Address',
            'state' => 'State',
            'crimeType' => 'Crime Type',
            'crimeDate' => 'Crime Date',
            'chargeDate' => 'Charge Date',
            'mod_id' => 'Mod',
            'registrar_id' => 'Registrar',
        ],
    ],

    'attorney_case_hearings' => [
        'name' => 'Attorney Case Hearings',
        'index_title' => 'CaseHearings List',
        'new_title' => 'New Case hearing',
        'create_title' => 'Create CaseHearing',
        'edit_title' => 'Edit CaseHearing',
        'show_title' => 'Show CaseHearing',
        'inputs' => [
            'casehearingID' => 'Casehearing Id',
            'modID' => 'Mod Id',
            'courtID' => 'Court Id',
            'judgeID' => 'Judge Id',
            'attorneyID' => 'Attorney Id',
            'attoneryWitnessID' => 'Attonery Witness Id',
            'accusedWitnessID' => 'Accused Witness Id',
            'chilotname' => 'Chilotname',
            'accEmpID' => 'Acc Emp Id',
            'fileNumber' => 'File Number',
            'caseStartDate' => 'Case Start Date',
            'address' => 'Address',
            'state' => 'State',
            'location' => 'Location',
            'description' => 'Description',
            'court_id' => 'Court',
            'mod_id' => 'Mod',
            'judge_id' => 'Judge',
            'witness_id' => 'Witness',
        ],
    ],

    'judge_case_hearings' => [
        'name' => 'Judge Case Hearings',
        'index_title' => 'CaseHearings List',
        'new_title' => 'New Case hearing',
        'create_title' => 'Create CaseHearing',
        'edit_title' => 'Edit CaseHearing',
        'show_title' => 'Show CaseHearing',
        'inputs' => [
            'casehearingID' => 'Casehearing Id',
            'modID' => 'Mod Id',
            'courtID' => 'Court Id',
            'judgeID' => 'Judge Id',
            'attorneyID' => 'Attorney Id',
            'attoneryWitnessID' => 'Attonery Witness Id',
            'accusedWitnessID' => 'Accused Witness Id',
            'chilotname' => 'Chilotname',
            'accEmpID' => 'Acc Emp Id',
            'fileNumber' => 'File Number',
            'caseStartDate' => 'Case Start Date',
            'address' => 'Address',
            'state' => 'State',
            'location' => 'Location',
            'description' => 'Description',
            'attorney_id' => 'Attorney',
            'court_id' => 'Court',
            'mod_id' => 'Mod',
            'witness_id' => 'Witness',
        ],
    ],

    'mod_case_charges' => [
        'name' => 'Mod Case Charges',
        'index_title' => 'CaseCharges List',
        'new_title' => 'New Case charge',
        'create_title' => 'Create CaseCharge',
        'edit_title' => 'Edit CaseCharge',
        'show_title' => 'Show CaseCharge',
        'inputs' => [
            'modID' => 'Mod Id',
            'MIDnumber' => 'Mi Dnumber',
            'rank' => 'Rank',
            'fullName' => 'Full Name',
            'address' => 'Address',
            'state' => 'State',
            'crimeType' => 'Crime Type',
            'crimeDate' => 'Crime Date',
            'chargeDate' => 'Charge Date',
            'mod_employee_id' => 'Mod Employee',
            'registrar_id' => 'Registrar',
        ],
    ],

    'mod_mod_employees' => [
        'name' => 'Mod Mod Employees',
        'index_title' => 'ModEmployees List',
        'new_title' => 'New Mod employee',
        'create_title' => 'Create ModEmployee',
        'edit_title' => 'Edit ModEmployee',
        'show_title' => 'Show ModEmployee',
        'inputs' => [
            'modID' => 'Mod Id',
            'EmpID' => 'Emp Id',
            'rank' => 'Rank',
            'fullName' => 'Full Name',
            'address' => 'Address',
            'state' => 'State',
            'empType' => 'Emp Type',
        ],
    ],

    'mod_case_hearings' => [
        'name' => 'Mod Case Hearings',
        'index_title' => 'CaseHearings List',
        'new_title' => 'New Case hearing',
        'create_title' => 'Create CaseHearing',
        'edit_title' => 'Edit CaseHearing',
        'show_title' => 'Show CaseHearing',
        'inputs' => [
            'casehearingID' => 'Casehearing Id',
            'modID' => 'Mod Id',
            'courtID' => 'Court Id',
            'judgeID' => 'Judge Id',
            'attorneyID' => 'Attorney Id',
            'attoneryWitnessID' => 'Attonery Witness Id',
            'accusedWitnessID' => 'Accused Witness Id',
            'chilotname' => 'Chilotname',
            'accEmpID' => 'Acc Emp Id',
            'fileNumber' => 'File Number',
            'caseStartDate' => 'Case Start Date',
            'address' => 'Address',
            'state' => 'State',
            'location' => 'Location',
            'description' => 'Description',
            'attorney_id' => 'Attorney',
            'court_id' => 'Court',
            'judge_id' => 'Judge',
            'witness_id' => 'Witness',
        ],
    ],

    'mod_appointments' => [
        'name' => 'Mod Appointments',
        'index_title' => 'Appointments List',
        'new_title' => 'New Appointment',
        'create_title' => 'Create Appointment',
        'edit_title' => 'Edit Appointment',
        'show_title' => 'Show Appointment',
        'inputs' => [
            'caseHearID' => 'Case Hear Id',
            'empID' => 'Emp Id',
            'modID' => 'Mod Id',
            'fullname' => 'Fullname',
            'chargeType' => 'Charge Type',
            'appointmentDate' => 'Appointment Date',
            'description' => 'Description',
            'case_hearing_id' => 'Case Hearing',
        ],
    ],

    'mod_decisions' => [
        'name' => 'Mod Decisions',
        'index_title' => 'Decisions List',
        'new_title' => 'New Decision',
        'create_title' => 'Create Decision',
        'edit_title' => 'Edit Decision',
        'show_title' => 'Show Decision',
        'inputs' => [
            'caseHearingID' => 'Case Hearing Id',
            'modID' => 'Mod Id',
            'empID' => 'Emp Id',
            'name' => 'Name',
            'chargeType' => 'Charge Type',
            'caseStartDate' => 'Case Start Date',
            'decisionDate' => 'Decision Date',
            'decisionType' => 'Decision Type',
            'description' => 'Description',
            'case_hearing_id' => 'Case Hearing',
        ],
    ],

    'case_hearing_appointments' => [
        'name' => 'CaseHearing Appointments',
        'index_title' => 'Appointments List',
        'new_title' => 'New Appointment',
        'create_title' => 'Create Appointment',
        'edit_title' => 'Edit Appointment',
        'show_title' => 'Show Appointment',
        'inputs' => [
            'caseHearID' => 'Case Hear Id',
            'empID' => 'Emp Id',
            'modID' => 'Mod Id',
            'fullname' => 'Fullname',
            'chargeType' => 'Charge Type',
            'appointmentDate' => 'Appointment Date',
            'description' => 'Description',
            'mod_id' => 'Mod',
        ],
    ],

    'case_hearing_decisions' => [
        'name' => 'CaseHearing Decisions',
        'index_title' => 'Decisions List',
        'new_title' => 'New Decision',
        'create_title' => 'Create Decision',
        'edit_title' => 'Edit Decision',
        'show_title' => 'Show Decision',
        'inputs' => [
            'caseHearingID' => 'Case Hearing Id',
            'modID' => 'Mod Id',
            'empID' => 'Emp Id',
            'name' => 'Name',
            'chargeType' => 'Charge Type',
            'caseStartDate' => 'Case Start Date',
            'decisionDate' => 'Decision Date',
            'decisionType' => 'Decision Type',
            'description' => 'Description',
            'mod_id' => 'Mod',
        ],
    ],

    'witness_case_hearings' => [
        'name' => 'Witness Case Hearings',
        'index_title' => 'CaseHearings List',
        'new_title' => 'New Case hearing',
        'create_title' => 'Create CaseHearing',
        'edit_title' => 'Edit CaseHearing',
        'show_title' => 'Show CaseHearing',
        'inputs' => [
            'casehearingID' => 'Casehearing Id',
            'modID' => 'Mod Id',
            'courtID' => 'Court Id',
            'judgeID' => 'Judge Id',
            'attorneyID' => 'Attorney Id',
            'attoneryWitnessID' => 'Attonery Witness Id',
            'accusedWitnessID' => 'Accused Witness Id',
            'chilotname' => 'Chilotname',
            'accEmpID' => 'Acc Emp Id',
            'fileNumber' => 'File Number',
            'caseStartDate' => 'Case Start Date',
            'address' => 'Address',
            'state' => 'State',
            'location' => 'Location',
            'description' => 'Description',
            'attorney_id' => 'Attorney',
            'court_id' => 'Court',
            'mod_id' => 'Mod',
            'judge_id' => 'Judge',
        ],
    ],

    'roles' => [
        'name' => 'Roles',
        'index_title' => 'Roles List',
        'create_title' => 'Create Role',
        'edit_title' => 'Edit Role',
        'show_title' => 'Show Role',
        'inputs' => [
            'name' => 'Name',
        ],
    ],

    'permissions' => [
        'name' => 'Permissions',
        'index_title' => 'Permissions List',
        'create_title' => 'Create Permission',
        'edit_title' => 'Edit Permission',
        'show_title' => 'Show Permission',
        'inputs' => [
            'name' => 'Name',
        ],
    ],
];
