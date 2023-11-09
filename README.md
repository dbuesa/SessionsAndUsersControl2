# PRÀCTICA 5

Si l'usuari ha oblidat la contrasenya podrà entrar a la secció trobada al inici de sessió de la pàgina "Has oblidat la contrasenya? Recupera-la". Allà haurà d'ingressar el seu correu electrònic amb el qual es va registrar a la pàgina. A partir d'aquest, se li enviarà un correu amb el següent model:

Hola, XXXX (nom de l'usuari extret a partir del correu),

Hem rebut una petició per recuperar la contrasenya del teu compte.
Clica al següent enllaç per a recuperar-la:
Recuperar contrasenya

Si no has estat tu, si us plau, ignora aquest missatge.

Salutacions,
Equip de David Buesa.

Es generarà un token alhora que s'envia el correu, i s'afegirà l'hora en què s'ha generat en un camp anomenat token_start a la nostra base de dades. Quan l'usuari entri a l'enllaç, aquest absorbira el seu token i comprovarà l'hora actual (i s'afegeix al camp token_expires). Si han passat més de 240 minuts (4 hores), direm que el seu token haurà expirat, sinó, podrà canviar correctament la seva contrasenya.

Si l'usuari s'equivoca més de dues vegades a l'hora d'inserir el nom d'usuari o la seva contrasenya, es redirigirà a una pàgina exactament igual que a la del inici de sessió, però se li afegeix el captcha, el qual no es pot evitar.

El botó d'"Iniciar sessió amb Google" (fet amb Oauth2) és el mateix tant en el inici de sessió com en el formulari de registre, ja que sinó aquesta opció no tindria cap sentit (no tindria sentit que si no t'has registrat abans amb Google no poguessis obrir sessió, per això ja hi és el registre típic). L'aplicació absorbeix el nom de l'usuari i el correu adherit a Google, però, com el nom que té a Google no és únic (poden existir dos comptes amb el nom d'usuari Xavier Martín), genera un petit token (12 caràcters) el qual s'adreça al seu nom d'usuari de Google, complint així el seu caràcter únic. Per diferenciar l'usuari que es registra o que inicia sessió, es fa mitjançant un condicional: si el correu amb el qual està intentant accedir ja existeix a la base de dades, implica que ja està registrat, per tant, només hem de crear una sessió amb el seu nom d'usuari. En el cas contrari (el correu no existeix), afegim el token al seu nom d'usuari, absorbim el correu i el registrem a la base de dades. Després iniciem la seva sessió.

El procediment amb "Iniciar sessió amb Github" és el mateix però fent servir HybridAuth.

Per tal de diferenciar a l'usuari provinent del Github del de Google (ja que existeix la casuística que un mateix correu electrònic es registri dels dos comptes) s'ha afegit al correu provinent del Github l'extensió ".github" (per exemple: d.buesa@sapalomera.cat.github).


David Buesa Lorente
