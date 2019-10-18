using System;
using Xunit;
using Utils;

namespace Tests
{
  public class CaesarTests
  {
    [Fact]
    public void Decipher()
    {
      var inputString = "Åcglsftfzzf vkvålåhhu ucrcffu zvzphhspzääååh qh rcrcf lzppuåcf åhp hpuhrpu åhyöpååhlzzh wpåff äzrhsåhh höhåh zääuzh rvrvärzpzzh.";
      var expectedString = "Työelämässä odotetaan nykyään sosiaalisuutta ja kykyä esiintyä tai ainakin tarvittaessa pitää uskaltaa avata suunsa kokouksissa.";
      var caesar = new Caesar {
        Alphabet = "abcdefghijklmnopqrstuvwxyzåäö",
        Shift = 7
      };
      var returnedString = caesar.Decipher(inputString);
      Assert.True(expectedString == returnedString, "The input string was not deciphered correctly. " + returnedString);
    }
  }
}
