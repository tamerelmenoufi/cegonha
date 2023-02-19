<?php
    include("{$_SERVER['DOCUMENT_ROOT']}/app/cegonha/painel/lib/includes.php");

    $query = "select * from vendas where codigo = '{$_SESSION['codVenda']}'";
    $result = mysqli_query($con, $query);
    $d = mysqli_fetch_object($result);



?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

  <script src="https://sdk.mercadopago.com/js/v2"></script>


<script>
  const mp = new MercadoPago("APP_USR-dc7289b9-3b81-47e0-b705-f935a324b0d7");
  // const mp = new MercadoPago("TEST-82f33771-bbd5-4bc6-93cb-e98715ea4d16");
</script>



<style>
    #form-checkout {
      display: flex;
      flex-direction: column;
      max-width: 600px;
    }

    .container {
      height: 18px;
      display: inline-block;
      border: 1px solid rgb(118, 118, 118);
      border-radius: 2px;
      padding: 1px 2px;
    }

    td{
      padding:5px;
    }

  </style>
  <form id="form-checkout">
    <table>
      <tr>
        <td>
          <div id="form-checkout__cardNumber" class="container"></div>
        </td>
      </tr>
      <tr>
        <td>
          <div id="form-checkout__expirationDate" class="container"></div>
        </td>
        <td>
          <div id="form-checkout__securityCode" class="container"></div>
        </td>
      </tr>
      <tr>
        <td>
          <input type="text" id="form-checkout__cardholderName" />
        </td>
      </tr>
      <tr>
        <td>
          <select id="form-checkout__issuer"></select>
        </td>
      </tr>
      <tr>
        <td>
          <select id="form-checkout__installments"></select>
        </td>
      </tr>
      <tr>
        <td>
          <select id="form-checkout__identificationType"></select>
        </td>
      </tr>

      <tr>
        <td>
          <input type="text" id="form-checkout__identificationNumber" />
        </td>
      </tr>
      <tr>
        <td>
          <input type="email" id="form-checkout__cardholderEmail" />
        </td>
      </tr>
      <tr>
        <td>
          <button type="submit" id="form-checkout__submit">Pagar</button>
        </td>
      </tr>
      <tr>
        <td>
          <input type="email" id="form-checkout__cardholderEmail" />
        </td>
      </tr>
      <tr>
        <td>
          <progress value="0" class="progress-bar">Carregando...</progress>
        </td>
      </tr>
    </table>
  </form>


<script>

    const cardForm = mp.cardForm({
      amount: "<?=(($_GET['v'])?:$d->total)?>",
      iframe: true,
      form: {
        id: "form-checkout",
        cardNumber: {
          id: "form-checkout__cardNumber",
          placeholder: "Número do cartão",
        },
        expirationDate: {
          id: "form-checkout__expirationDate",
          placeholder: "MM/YY",
        },
        securityCode: {
          id: "form-checkout__securityCode",
          placeholder: "Código de segurança",
        },
        cardholderName: {
          id: "form-checkout__cardholderName",
          placeholder: "Titular do cartão",
        },
        issuer: {
          id: "form-checkout__issuer",
          placeholder: "Banco emissor",
        },
        installments: {
          id: "form-checkout__installments",
          placeholder: "Parcelas",
        },
        identificationType: {
          id: "form-checkout__identificationType",
          placeholder: "Tipo de documento",
        },
        identificationNumber: {
          id: "form-checkout__identificationNumber",
          placeholder: "Número do documento",
        },
        cardholderEmail: {
          id: "form-checkout__cardholderEmail",
          placeholder: "E-mail",
        },
      },
      callbacks: {
        onFormMounted: error => {
          if (error) return console.log("Form Mounted handling error: ", error);
          console.log("Form mounted");
        },
        onSubmit: event => {
          event.preventDefault();

          const {
            paymentMethodId: payment_method_id,
            issuerId: issuer_id,
            cardholderEmail: email,
            amount,
            token,
            installments,
            identificationNumber,
            identificationType,
          } = cardForm.getCardFormData();

          fetch("/cartao/pagar.php", {
            method: "POST",
            headers: {
              "Content-Type": "application/json",
            },
            body: JSON.stringify({
              token,
              issuer_id,
              payment_method_id,
              transaction_amount: Number(amount),
              installments: Number(installments),
              description: "Chá Revelação",
              payer: {
                email,
                identification: {
                  type: identificationType,
                  number: identificationNumber,
                },
              },
            }),
          });
          parent.payConfirm();

        },
        onFetching: (resource) => {
          console.log("Fetching resource: ", resource);

          // Animate progress bar
          const progressBar = document.querySelector(".progress-bar");
          progressBar.removeAttribute("value");

          return () => {
            progressBar.setAttribute("value", "0");
          };
        }
      },
    });

</script>

</body>
</html>