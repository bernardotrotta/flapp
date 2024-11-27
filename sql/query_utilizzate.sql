-- DETTAGLI VOLO: fornisce informazioni sui voli
SELECT V.ID_VOLO,
V.Data_partenza,
V.Orario_partenza,
V.Durata,
A1.Nome AS Aeroporto_partenza,
A2.Nome AS Aeroporto_arrivo,
AER.Modello AS Aereo_Impiegato,
P.Nome AS Nome_Pilota,
P.Cognome AS Cognome_Pilota

FROM Voli V
JOIN Aeroporti A1 ON V.Aeroporto_partenza = A1.ID_AEROPORTO
JOIN Aeroporti A2 ON V.Aeroporto_arrivo = A2.ID_AEROPORTO
JOIN Aerei AER ON V.Aereo = AER.ID_AEREO
JOIN Servizio S ON V.ID_VOLO = S.ID_volo
JOIN Personale P ON S.ID_dipendente = P.ID_DIPENDENTE

WHERE V.ID_VOLO = 'FL00000002' AND
P.Ruolo = 'Pilota';


-- AEREO PIÙ UTILIZZATO: aereo che è stato coinvolto in più voli
SELECT 
    a.Modello,
    COUNT(v.ID_VOLO) AS Numero_voli
FROM 
    Aerei a
JOIN 
    Voli v ON a.ID_AEREO = v.Aereo
GROUP BY 
    a.ID_AEREO, a.Modello
ORDER BY 
    Numero_voli DESC
LIMIT 1;

-- AEROPORTI CON PIÙ ARRIVI
SELECT 
    a.ID_AEROPORTO,
    a.Nome,
    a.Codice_iata,
    (SELECT COUNT(v1.ID_VOLO)
     FROM Voli v1
     WHERE v1.Aeroporto_arrivo = a.ID_AEROPORTO) AS Numero_arrivi
FROM 
    Aeroporti a
WHERE 
    (SELECT COUNT(v2.ID_VOLO)
     FROM Voli v2
     WHERE v2.Aeroporto_arrivo = a.ID_AEROPORTO) >= ALL
    (SELECT COUNT(v3.ID_VOLO)
     FROM Voli v3
     GROUP BY v3.Aeroporto_arrivo);

-- AEROPORTI CON PIÙ PARTENZE
SELECT 
    a.ID_AEROPORTO,
    a.Nome,
    a.Codice_iata,
    (SELECT COUNT(v1.ID_VOLO)
     FROM Voli v1
     WHERE v1.Aeroporto_partenza = a.ID_AEROPORTO) AS Numero_partenze
FROM 
    Aeroporti a
WHERE 
    (SELECT COUNT(v2.ID_VOLO)
     FROM Voli v2
     WHERE v2.Aeroporto_partenza = a.ID_AEROPORTO) >= ALL
    (SELECT COUNT(v3.ID_VOLO)
     FROM Voli v3
     GROUP BY v3.Aeroporto_partenza);

-- DURATA DEL VOLO INSERENDO CITTÀ DI PARTENZA E ARRIVO
SELECT 
    v.Durata
FROM 
    Voli v
JOIN 
    Aeroporti a_partenza ON v.Aeroporto_partenza = a_partenza.ID_AEROPORTO
JOIN 
    Aeroporti a_arrivo ON v.Aeroporto_arrivo = a_arrivo.ID_AEROPORTO
WHERE 
    a_partenza.Città = 'New York'
    AND a_arrivo.Città = 'Madrid'
LIMIT 1;

-- DIPENDENTE PUÒ VEDERE SU QUALI VOLI HA OPERATO FINO AD ORA, INSERENDO IL PROPRIO CODICE DIPENDENTE
SELECT 
    V.ID_VOLO, 
    AP.Nome AS Nome_Aeroporto_Partenza, 
    AP1.Nome AS Nome_Aeroporto_Arrivo, 
    V.Data_partenza,
    V.Orario_partenza
FROM 
    Servizio S
JOIN 
    Voli V ON S.ID_volo = V.ID_VOLO
JOIN 
    Aeroporti AP ON V.Aeroporto_partenza = AP.ID_AEROPORTO
JOIN 
	Aeroporti AP1 ON V.Aeroporto_arrivo = AP1.ID_AEROPORTO
WHERE 
    S.ID_dipendente = 'DIP0000006' AND
    v.data_partenza <= CURRENT_DATE;

-- DIPENDENTE PUÒ VEDERE SU QUALI VOLI DEVE OPERARE IN FUTURO, INSERENDO IL CODICE DIPENDENTE
SELECT 
    V.ID_VOLO, 
    AP.Nome AS Nome_Aeroporto_Partenza, 
    AP1.Nome AS Nome_Aeroporto_Arrivo, 
    V.Data_partenza,
    V.Orario_partenza
FROM 
    Servizio S
JOIN 
    Voli V ON S.ID_volo = V.ID_VOLO
JOIN 
    Aeroporti AP ON V.Aeroporto_partenza = AP.ID_AEROPORTO
JOIN 
	Aeroporti AP1 ON V.Aeroporto_arrivo = AP1.ID_AEROPORTO
WHERE 
    S.ID_dipendente = 'DIP0000006' AND
    v.data_partenza >= CURRENT_DATE;


-- DIPENDENTE PUÒ VEDERE QUANTE ORE HA LAVORATO QUESTO MESE, ORE TOTALI DI VOLO IL MESE CORRENTE
SELECT SUM(V.Durata) AS Totale_ore
FROM Voli V
JOIN
	Servizio S ON V.ID_VOLO = S.ID_volo
JOIN
	Personale P ON S.ID_dipendente = P.ID_DIPENDENTE

WHERE P.ID_DIPENDENTE = 'DIP0000001' AND
	  MONTH(V.Data_partenza) = MONTH(CURDATE()) AND
      YEAR(V.Data_partenza) = YEAR(CURDATE()) AND
      V.Data_partenza <= CURRENT_DATE;
 
— PROSSIMO VOLO
SELECT 
    v.ID_VOLO,
    v.Data_partenza,
    v.Orario_partenza,
    AP.Nome AS Nome_Aeroporto_Partenza, 
    AP1.Nome AS Nome_Aeroporto_Arrivo, 
    v.Durata,
    v.Aereo
FROM 
    Servizio s
JOIN 
    Voli v ON s.ID_volo = v.ID_VOLO
JOIN 
    Aeroporti AP ON V.Aeroporto_partenza = AP.ID_AEROPORTO
JOIN 
	Aeroporti AP1 ON V.Aeroporto_arrivo = AP1.ID_AEROPORTO
WHERE 
    s.ID_dipendente = 'DIP0000001'
    AND v.Data_partenza >= CURDATE() -- Filtra solo i voli futuri
    AND (v.Data_partenza > CURDATE() OR (v.Data_partenza = CURDATE() AND v.Orario_partenza > CURTIME())) 
ORDER BY 
    v.Data_partenza ASC, v.Orario_partenza ASC
LIMIT 1;



-- DIPENDENTE DEL MESE (CHE HA LAVORATO PIÙ ORE)
SELECT 
    p.Nome,
    p.Cognome,
    p.Ruolo,
    SUM(v.Durata) AS Ore_lavorate
FROM 
    Personale p
JOIN 
    Servizio s ON p.ID_DIPENDENTE = s.ID_dipendente
JOIN 
    Voli v ON s.ID_volo = v.ID_VOLO
WHERE 
    MONTH(v.Data_partenza) = MONTH(CURDATE())
    AND YEAR(v.Data_partenza) = YEAR(CURDATE())
    AND v.data_partenza <= CURRENT_DATE
    
GROUP BY 
    p.ID_DIPENDENTE
ORDER BY 
    Ore_lavorate DESC
LIMIT 1;

-- DATO UN ID_UTENTE, RESTITUIRE TUTTI I VOLI PRENOTATI
SELECT 
    P.Nome AS Nome_Passeggero,
    P.Cognome AS Cognome_Passeggero,
    Pr.ID_PRENOTAZIONE AS Codice_prenotazione,
    V.Data_partenza,
    A1.Città AS Città_partenza,
    A1.Nome AS Aeroporto_partenza,
    A2.Città AS Città_arrivo,
    A2.Nome AS Aeroporto_arrivo,
    Pr.Prezzo_biglietto
FROM 
    Prenotazioni Pr
JOIN 
    Passeggeri P ON Pr.Passeggero = P.ID_PASSEGGERO
JOIN 
    Voli V ON Pr.Volo = V.ID_VOLO
JOIN 
    Aeroporti A1 ON V.Aeroporto_partenza = A1.ID_AEROPORTO
JOIN 
    Aeroporti A2 ON V.Aeroporto_arrivo = A2.ID_AEROPORTO
    
WHERE P.ID_PASSEGGERO = '1122334455';

-- NUMERO DI VOLI PRENOTATI
SELECT 
    COUNT(DISTINCT Pr.Volo) AS Numero_di_voli_prenotati
FROM 
    Prenotazioni Pr
JOIN 
    Passeggeri P ON Pr.Passeggero = P.ID_PASSEGGERO
WHERE 
    P.ID_PASSEGGERO= '1122334455';
    
-- PROSSIMA DESTINAZIONE
SELECT 
    A2.Città AS Prossima_destinazione
FROM 
    Prenotazioni Pr
JOIN 
    Voli V ON Pr.Volo = V.ID_VOLO
JOIN 
    Aeroporti A2 ON V.Aeroporto_arrivo = A2.ID_AEROPORTO
WHERE 
    Pr.Passeggero = '1122334455'
    AND V.Data_partenza > CURDATE()
ORDER BY 
    V.Data_partenza ASC
LIMIT 1;

-- INSERISCI CODICE PRENOTAZIONE PER VEDERE I DETTAGLI
SELECT 
    V.Data_partenza,
    V.Orario_partenza,
    A1.Città AS Città_partenza,
    A1.Nome AS Aeroporto_partenza,
    V.Data_arrivo,
    V.Orario_arrivo,
    A2.Città AS Città_arrivo,
    A2.Nome AS Aeroporto_arrivo,
    V.Durata
FROM 
    Prenotazioni Pr
JOIN 
    Voli V ON Pr.Volo = V.ID_VOLO
JOIN 
    Aeroporti A1 ON V.Aeroporto_partenza = A1.ID_AEROPORTO
JOIN 
    Aeroporti A2 ON V.Aeroporto_arrivo = A2.ID_AEROPORTO
WHERE 
    Pr.ID_PRENOTAZIONE = 'BK00000003';


-- OTTIENI LA LISTA DELLE POSSIBILI SOSTITUIZIONI
SELECT 
    V.Data_partenza,
    V.Orario_partenza,
    A1.Città AS Città_partenza,
    A1.Codice_iata AS Aeroporto_partenza,
    V.Data_arrivo,
    V.Orario_arrivo,
    A2.Città AS Città_arrivo,
    A2.Codice_iata AS Aeroporto_arrivo,
    V.Durata
FROM 
    Voli AS V
JOIN 
    Aeroporti A1 ON V.Aeroporto_partenza = A1.ID_AEROPORTO
JOIN 
    Aeroporti A2 ON V.Aeroporto_arrivo = A2.ID_AEROPORTO
WHERE 
    A1.Codice_iata = "MAD"
AND
    A2.Codice_iata = "NRT"
AND V.Data_partenza > CURRENT_DATE();


-- Numero di prenotazioni per volo
SELECT 
    Volo AS ID_VOLO, 
    COUNT(*) AS Posti_occupati
FROM 
    Prenotazioni
WHERE 
	Volo = "FL00000001"
GROUP BY 
    Volo;

-- Posti disponibili per volo
SELECT 
    A.Capacità AS Posti_disponibili
FROM
    Aerei A
JOIN 
    Voli V ON A.ID_AEREO = V.Aereo
WHERE 
	V.ID_VOLO = "FL00000002";

-- TROVARE IL PREZZO DELLA PRENOTAZIONE VECCHIA DA MANTENERE PER QUELLA NUOVA
SELECT Prezzo_biglietto
FROM Prenotazioni
WHERE ID_PRENOTAZIONE = "BK00000001";

-- INSERIRE UNA NUOVA QUERY
INSERT INTO `Prenotazioni` (`ID_PRENOTAZIONE`, `Passeggero`, `Volo`, `Prezzo_biglietto`) VALUES
('BK00000001', '1234567890', 'FL00000001', '189.67');

-- CONTA I POSTI VUOTI
SELECT 
    V.ID_VOLO,
    A.Capacità - IFNULL(COUNT(P.ID_PRENOTAZIONE), 0) AS Posti_disponibili
FROM 
    Voli V
JOIN 
    Aerei A ON V.Aereo = A.ID_AEREO
LEFT JOIN 
    Prenotazioni P ON V.ID_VOLO = P.Volo
WHERE 
    V.ID_VOLO = "FL00000002"
GROUP BY 
    V.ID_VOLO, A.Capacità;

-- QUERY PER GENERARE NUOVO ID PRENOTAZIONE
-- siccome gli ID delle preontazioni sono generati in modo incrementale
-- per generare un nuovo ID univoco, possiamo estrarre il massimo valore esistente degli ID di prenotazione già presenti nel database, incrementandolo di 1 
-- SUBSTRING: estrae una sottostringa dall'ID a partire dal terzo carattere
-- CAST AS UNSIGNED: converte la sottostringa in un intero
-- MAX: trova il valore massimo tra gli ID convertiti in interi
-- CAST AS CHAR: converte in stringa il valore del ID massimo aumentato di uno
-- LPAD: riempie la stringa  NuovoID_Prenotazione con il valore ottenuto
-- CONCAT: aggiunge le iniziali BK

SELECT CONCAT("BK",LPAD(CAST(MAX(CAST(SUBSTRING(ID_PRENOTAZIONE, 3) AS UNSIGNED)) + 1 AS CHAR), 8, '0')) AS NuovoID_Prenotazione
FROM Prenotazioni;


-- ELIMINARE PRENOTAZIONE VECCHIA
DELETE FROM Prenotazioni
WHERE ID_PRENOTAZIONE = "BK00000001";










